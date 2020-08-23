@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="row">
            <!-- Default box -->
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Danh sách {{$nowstatus->comment}}</h3>
                            </div>
                            <div class="box-body">
                                <table id="alluserstable" class="table table-responsive table-bordered table-hover table-striped">
                                    <thead>
                                    <tr align="center">
                                        <th>STT</th>
                                        <th>Hình ảnh</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Khách hàng</th>
                                        <th>Ngày gửi</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   @foreach($complaints as $key=>$value)
                                       <tr>
                                           <td><b> {{$key+1}}</b></td>
                                           <td>  {{$value->images}}</td>
                                           <td> 
												@if($value->reference)
													{{$value->reference->code}}
												@endif
											</td>
                                           <td> {{$value->created_at}}</td>
                                           <td>  {{$value->customer->username}}</td>
                                           <td>  {{$value->complaintstatus->name}}</td>
                                           <td>
                                               <a class="btn btn-xs btn-default btn-flat" href="{{url('admin/view/complaint/'.$value->id)}}">
                                                   <i class="fa fa-eye text-blue"></i> Xem
                                               </a>

                                               @can('complaint_management')
                                                   <a data-url="{{url('admin/movestatus/complaint/'.$value->id)}}" class="btn btn-xs btn-default btn-flat" data-toggle="modal" data-target="#StatusComplaint">
                                                       <i class="fa fa-edit text-blue"></i> Chuyển Trạng thái
                                                   </a>
                                                   @if($value->complaintstatus->code == 'cancelled')
                                                       <a data-title="Xác nhận xóa đơn khiếu nại!" data-body="Bạn có chắc chắn xóa đơn khiếu nại?" href="{{ url('admin/delete/order/'.$value->id) }}" class="btn btn-xs btn-default btn-flat confirm-link"><i class="fa fa-trash text-red" data-toggle="tooltip" title="{{ trans('VNPCMS.forms.titles.delete') }}"></i></a>
                                                   @endif
                                               @endcan


                                           </td>
                                       </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.box -->
        </div>

        <!---- Modal chuyển trạng thái đơn hàng---->
        <div class="modal fade" tabindex="-1" role="dialog" id="StatusComplaint">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Chuyển trạng thái {{$type->name}}</h4>
                    </div>
                    {!! Form::open(['method' => 'POST', 'id'=>'Complaint']) !!}
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control" name="status">
                                        @foreach($status as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Hủy bỏ</button>
                        <button type="submit" class="btn btn-danger pull-left"><i class="fa fa-trash"></i> Đồng ý</button>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </section><!-- /.content -->
    @endsection