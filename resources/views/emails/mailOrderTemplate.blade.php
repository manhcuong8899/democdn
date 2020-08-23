@extends('layouts.mailTemplate')
@section('mail-content')
{{$content}}
<section class="content">
    @foreach($order->ordershopdetails as $keyShop => $aShop)
    <div class="row shop-item">
        <div style="width: 75%;float: left;">
            
            <h5>
                <i class="stt">{{$keyShop+1}}) &nbsp;</i>Nhà cung cấp: {{$aShop->name}}
            </h5>
            <table border='1'>
                <thead>
                    <tr>
                        <th></th>
                        <th>Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Ghi chú</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aShop->orderproductdetails as $keyProduct => $aProduct)
                    <tr>
                        <td class="product-check"><i class="stt">1</i></td>
                        <td>
                            <div class="san-pham-item-muilt-item">
                                <div style="position: relative;float: left;">
                                    <div class="image">
                                        <a href="{{$aShop->url}}" target="_blank">
                                            <img width="75" height="75" src="{{$aProduct->image}}">
                                        </a>
                                    </div>
                                </div>
                                <a href="{{$aShop->url}}" target="_bank">{{$aProduct->name}}</a>                                                        
                            </div>
                        </td>
                        <td>
                            <div class="price" style="margin-top:10px;">
                                <span class="vnd-unit">{{$aProduct->price * $aShop->rate}}<em>đ</em></span><br>
                                <span class="china-unit"><em>{{$aShop->currencysymbol}}</em><b>{{$aProduct->price}}</b></span>
                            </div>
                        </td>
                        <td>{{$aProduct->quantity}}</td>
                        <td>{{$aProduct->note}}</td>
                        <td>
                            <div class="thanh-tien">
                                <span class="vnd-unit vnd-unit-total-0"><b>{{$aProduct->price * $aProduct->quantity * $aShop->rate}}</b><em>đ</em></span><br>
                                <span class="china-unit china-unit-total-0"><em>{{$aShop->currencysymbol}}</em><b>{{$aProduct->price * $aProduct->quantity}}</b></span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>        
    </div>

@endforeach

<div class="row">
    <table>
        <tbody>
            <tr class="info">
                <td colspan="2">
                    <span>I. Thông tin đơn hàng</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Mã đơn hàng</label>
                    {{$order->code}}
                </td>
                <td>
                    <label>Trạng thái</label>
                    <span class="badge" style="background:{{$order->statusorder->color}};color: #fb5d14;font-size: 18px;">{{$order->statusorder->name}}</span>
                </td>
            </tr>
			<tr>
				<td>
					<label>Phí vận chuyển</label>
					<b style="color: #fb5d14;font-size: 18px;">{{$order->totalfeeforeignvietnamfreight}}</b><em>đ</em>
				</td>
				<td>
					<label>Đặt cọc</label>
					<b style="color: #fb5d14;font-size: 18px;">{{$order->fee_insurrance}}</b><em>đ</em>
				</td>
			</tr>
            <tr>
                <td>
                    <label>Phí giao dịch</label>
                    <b style="color: #fb5d14;font-size: 18px;">{{$order->totalproductprices*$order->fee_transaction/100}}</b><em>đ</em>
                </td>
                <td>
                    <label>Tổng tiền đặt hàng</label>
                    <b style="color: #fb5d14;font-size: 18px;">{{$order->totalproductprices}}</b><em>đ</em>
                </td>
            </tr>
			<tr>
				<td>
					<label>Tổng cước vận chuyển từ nước ngoài về VN</label>
					<b style="color: #fb5d14;font-size: 18px;">{{$order->totalfeeforeignvietnamfreights}}</b><em>đ</em>
				</td>
				<td>
					<label>Tổng cước vận chuyển nội địa nước ngoài</label>
					<b style="color: #fb5d14;font-size: 18px;">{{$order->totalfeeforeigninlandfreights}}</b><em>đ</em>
				</td>
			</tr>
			<tr>
				<td>
					<label>Thuế nước ngoài</label>
					<b style="color: #fb5d14;font-size: 18px;">{{$order->totalspecialtax}}</b><em>đ</em>
				</td>
				<td>
					<label>Cân nặng</label>
					{{$order->weight}}
				</td>
			</tr>
			<tr>
				<td>
					<label>Ngày hàng về</label>
					<b style="color: #fb5d14;font-size: 18px;">{{$order->arrive_date?date('Y-m-d', strtotime($order->arrive_date)):'' }}</b>
				</td>
				<td>
					<label>Ngày xuất kho</label>
					<b style="color: #fb5d14;font-size: 18px;">{{$order->output_date?date('Y-m-d', strtotime($order->output_date)):'' }}</b>
				</td>
			</tr>
            <tr>
                <td>
                    <label>Ngày tạo đặt</label>
                    {{date('d/m/Y H:i:s', strtotime($order->created_at)) }}
                </td>
                <td>
                    <label>Tổng tiền</label>
                    <b style="color: #fb5d14;font-size: 18px;">{{$order->totalprices}}</b><em>đ</em>
                </td>
            </tr>
            <tr class="info">
                <td colspan="2"><span>II. Thông tin khách hàng</span></td>
            </tr>
            <tr>
                <td>
                    <label>Họ và tên</label>
                    {{$order->fullname}}
                </td>
                <td>
                    <label>Số điện thoại</label>
                    {{$order->phone}}
                </td>
            </tr>
            <tr>
                <td>
                    <label>Email</label>
                    {{$order->email}}
                </td>
                <td>

                    <label>Địa chỉ</label>
                    {{$order->address}}
                </td>
            </tr>
        </tbody>
    </table>
</div>

</section>
@endsection