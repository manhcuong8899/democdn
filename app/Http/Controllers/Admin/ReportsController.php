<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderProductDetail;
use App\Utils\FileUtils;
use Auth;
use Flash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use PHPExcel_Worksheet_MemoryDrawing;
use PHPExcel_Style_Alignment;
use \Carbon\Carbon;
use Log;

class ReportsController extends Controller {

    public function online() {
        $status = \VNPCMS\Orders\StatusOrder::where('type_order', '=', 1)->lists('name', 'id')->toArray();

		
        $fromdate = Carbon::now()->subHour(6);
        $todate = Carbon::now();
        return view('reports.online')
                        ->with('fromdate', $fromdate)
                        ->with('todate', $todate)
                        ->with('status', $status);
    }
	public function imagecreatefromfile( $filename ) {
		try{
			return imagecreatefromjpeg($filename);
		}
		catch(\Exception $ex){
		}
		
		try{
			return imagecreatefrompng($filename);
		   
		}
		catch(\Exception $ex){
		}
		
		try{
			return imagecreatefromgif($filename);
		}
		catch(\Exception $ex){
		}
		
		try{
		   
			return imagecreatefromwebp($filename);
		}
		catch(\Exception $ex){
		}
	}
    public function orderexcel(Request $request) {
        $todate = Carbon::createFromFormat("Y-m-d H:i:s", $request->todate);
        $todateStr = date_format($todate, 'Y-m-d');
        $fromdate = Carbon::createFromFormat("Y-m-d H:i:s", $request->fromdate);
        $fromdateStr = date_format($fromdate, 'Y-m-d');


        $tygia = number_format($this->GetTygia('china'), 0, ',', '.');
        ini_set('max_execution_time', 360);
        ini_set('max_input_time', 300);

        if ($request->fromdate != '' && $request->todate != '') {
            $filename = 'Mua hàng_' . $fromdateStr . '_' . $todateStr;
            $date = 'Ngày: ' . $request->fromdate . ' đến ' . $request->todate;
        }

        if ($request->fromdate != '' && $request->todate == '') {
            $filename = 'Mua hàng_' . $fromdateStr;
            $date = 'Ngày: ' . $request->fromdate;
        }
        if ($request->fromdate == '' || $request->todate == '') {
            return redirect()->back()->withErrors('Nhập thời gian lọc dữ liệu cần kết xuất!');
        }
        if (abs($todate->diffInHours($fromdate)) > 24) {
            return redirect()->back()->withErrors('Bạn chỉ được nhập khoảng thời gian từ bắt đầu đến kết thúc trong khoảng 24 tiếng!');
        }

        $query = OrderProductDetail::join('order_shop_detail', 'order_product_detail.shop_id', '=', 'order_shop_detail.id')
                ->join('order', 'order_shop_detail.order_id', '=', 'order.id')
                ->leftJoin('users', 'users.id', '=', 'order.creator_id')
                ->select(
                        'order_product_detail.name', 'order_product_detail.quantity', 'order_product_detail.price', 'order_product_detail.image', 'order_product_detail.description', 'order_product_detail.note', 'order_shop_detail.website', 'order_shop_detail.currency_id', 'order_shop_detail.name as shopname', 'order_shop_detail.url', 'order.code', 'order.fullname', 'users.user_handle_id', 'order.created_at'
                )
                ->where(function ($query) use ($request, $todate, $fromdate) {
            $query->where('order_product_detail.created_at', '>=', $fromdate);
            $query->where('order_product_detail.created_at', '<=', $todate);
        });
        if ($request->status) {
            $query->where('order.status', '=', $request->status);
        }
        $lists = $query
                ->orderBy('order_shop_detail.website')
                ->get();
        $count = $lists->count();
        if ($count == 0) {
            return redirect()->back()->withErrors('Không có dữ liệu mua hàng trong thời gian đã chọn!');
        }

        return Excel::create($filename, function($excel) use ($filename, $lists, $tygia, $date) {
                    // Set the title
                    $excel->setTitle($filename);
                    $excel->sheet($filename, function($sheet) use ($lists, $tygia, $date) {
                        $sheet->setAutoSize(array(
                            'D', 'G'
                        ));
                        /* Format tiêu đề báo cáo */
                        $sheet->getRowDimension(1)->setRowHeight(50);
                        $sheet->setCellValue('E1', 'ĐƠN ĐẶT HÀNG TRUNG QUỐC');
                        $sheet->mergeCells('E1:G1');
                        $sheet->getStyle('E1')->getAlignment()->applyFromArray(
                                array('horizontal' => 'center',
                                    'vertical' => 'center')
                        );
                        $sheet->cells('E1', function($cells) {
                            $cells->setFont(array(
                                'family' => 'Calibri',
                                'size' => '15',
                                'bold' => true
                            ));
                        });
                        /* Format ngày tháng dữ liệu xuất báo cáo */
                        $sheet->setCellValue('E2', $date);
                        $sheet->mergeCells('E2:G2');
                        $sheet->getStyle('E2')->getAlignment()->applyFromArray(
                                array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
                        );
                        $sheet->cells('E2', function($cells) {
                            $cells->setFont(array(
                                'family' => 'Calibri',
                                'size' => '13',
                                'bold' => true
                            ));
                        });

                        /* Format cell tỷ giá */
                        $sheet->setCellValue('A3', 'Tỷ giá: ' . $tygia);
                        $sheet->mergeCells('A3:C3');
                        $sheet->cells('A3', function($cells) {
                            $cells->setBackground('#ff0000');
                            $cells->setFontColor('#ffffff');
                            $cells->setFont(array(
                                'bold' => true
                            ));
                        });
                        $sheet->getStyle('A3')->getAlignment()->applyFromArray(
                                array('horizontal' => 'center',
                                    'vertical' => 'center')
                        );

                        /* Format cell Mã PO  */
                        $sheet->setCellValue('D2', 'PO: ');
                        $sheet->cells('D2', function($cells) {
                            $cells->setBackground('#748aab');
                            $cells->setFontColor('#ffffff');
                            $cells->setFont(array(
                                'bold' => true
                            ));
                        });
                        /* Format cell Mã Bill  */
                        $sheet->setCellValue('D3', 'CN');
                        $sheet->mergeCells('A3:C3');
                        $sheet->cells('D3', function($cells) {
                            $cells->setBackground('#085ad5');
                            $cells->setFontColor('#ffffff');
                            $cells->setFont(array(
                                'bold' => true
                            ));
                        });

                        /* Format style nhãn tiêu đề */
                        $sheet->cells('A4:U4', function($cells) {
                            $cells->setFont(array(
                                'family' => 'Calibri',
                                'size' => '12',
                                'bold' => true
                            ));
                        });
                        $sheet->row(4, array(
                            'TT',
                            'PO',
                            'Mã SCD',
                            'Ngày Order',
                            'Link SP',
                            'Hãng, Tên Website',
                            'Tên Hàng',
                            'Bar Code',
                            'Chi tiết hàng',
                            'Số lượng',
                            'Giá Tệ 1 SP',
                            'Ghi chú Hình ảnh',
                            'Sales',
                            'Khách hàng',
                            'Tổng Tệ',
                            'SHIP Nội địa',
                            'TT',
                            'Ghi chú',
                            'MVC',
                            'Tình trạng hàng',
                        ));
                        foreach ($lists as $key => $list) {
                            if ($list->user_handle_id != null) {
                                $admin = User::find($list->user_handle_id);
                                $sales = $admin->full_name;
                            } else {
                                $sales = "Chưa phân Sales";
                            }
                            $row = $key + 5;
								if ($list->image != null || $list->image != "") {
									try{
										$path = explode("//", $list->image);
										$linkimages = $list->image;
										if ($path[0] == "") {
											$linkimages = 'https://' . $path[1];
										}
										$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
										$gdImage = $this->imagecreatefromfile($linkimages);
										$objDrawing->setImageResource($gdImage);
										$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
										$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
										$objDrawing->setCoordinates('L' . $row);
										$objDrawing->setHeight(50);
										$objDrawing->setWorksheet($sheet);
									}catch(Exception $ex){
										Log::error($ex);
									}
								}

                            /* Ket thuc chen hinh anh */
                            $sheet->getRowDimension($row)->setRowHeight(50);
                            $sheet->getStyle('L' . $row)->getAlignment()->applyFromArray(
                                    array('horizontal' => 'center')
                            );
                            /* Format cell Tổng Tiền */
                            $sheet->cells('P' . $row, function($cells) {
                                $cells->setFontColor('#ff0000');
                                $cells->setFont(array(
                                    'bold' => true
                                ));
                            });

                            /* Format cell Tổng Tiền */
                            $sheet->cells('K' . $row, function($cells) {
                                $cells->setFontColor('#ff0000');
                                $cells->setFont(array(
                                    'bold' => true
                                ));
                            });


                            /* Chen dong Excel */
                            $sheet->row($row, array(
                                $key + 1,
                                '',
                                $list->code,
                                date($list->created_at),
                                url($list->url),
                                $list->website,
                                $list->name,
                                '',
                                $list->description,
                                $list->quantity,
                                $list->price,
                                '',
                                $sales,
                                $list->fullname,
                                $list->quantity * $list->price,
                                '',
                                '',
                                $list->note,
                                '',
                                '',
                            ));
                        }

                        /*  $sheet->fromArray($data); */
                    });
                })->export('xls');
    }

}
