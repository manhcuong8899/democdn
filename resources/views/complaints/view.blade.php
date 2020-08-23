@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
		@if($complaint->reference && $complaint->type == 1)
        <h1>Đơn khiếu nại đơn hàng: <a href="{{url('order/show?id='.$complaint->reference->id)}}" target="_blank">{{$complaint->reference->code}}</a></h1>
		@elseif($complaint->reference && $complaint->type == 2)
        <h1>Đơn khiếu nại ký gửi: <a href="{{url('package/show?id='.$complaint->reference->id)}}" target="_blank">{{$complaint->reference->code}}</a></h1>
		@endif
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default col-md-12">
                    <div class="box-body">
                        <div class="col-md-7">
                            <div class="box-header with-border">
                                <i class="fa fa-warning"></i>
                                <h3 class="box-title">Nội dung gửi khiếu nại</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> {{$complaint->title}}</h4>
                                    {!!$complaint->short!!}
                                </div>
                                <div class="col-md-6">
                                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                                    <div class="form-group">
                                        <label>Email khách hàng</label>
                                        <p> <a href="mailto:{{$customer->email}}?subject=Trả lời khiếu nại {{$complaint->reference->code}}">{{$customer->email}}</a> </p>
                                    </div>
                                        @else
                                        <div class="form-group">
                                            <label>Email hỗ trợ xử lý</label>
                                            <p> <a href="mailto:{{$customer->email}}?subject=Trả lời khiếu nại {{$complaint->reference->code}}">{{$customer->email}}</a> </p>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label>Xem chi tiết đơn hàng</label>
									@if($complaint->reference && $complaint->type == 1)
                                    <p><a href="{{url('order/show?id='.$complaint->reference->id)}}">{{$complaint->reference->code}}</a></p>
									@elseif($complaint->reference && $complaint->type == 2)
                                    <p><a href="{{url('package/show?id='.$complaint->reference->id)}}">{{$complaint->reference->code}}</a></p>
									@endif
                                </div>
                                <div class="col-md-12">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">File đính kèm</h3>
                                    </div>
                                    <div class="box-body">
                                        <table id="attachments"  class="table table-bordered ">
                                            <tbody>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    @foreach( $files as $index=>$file )
                                                        <tr>
                                                            <td>{{$index+1}}</td>
                                                            <td><a href="{{url('public/files/complaint/'.$complaint->reference->code.'/'.File::name('files/'.$file).'.'.File::extension('files/'.$file))}}"> {{File::name('files/'.$file)}}. {{File::extension('files/'.$file)}}</a> </td>
                                                        </tr>
                                                    @endforeach
                                                </div>
                                            </div>
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>





                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="box-header with-border">
                                <i class="fa fa-user"></i>
                                <h3 class="box-title">Thông tin khách hàng gửi khiếu nại</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Họ và tên</label>
                                    <input type="text" class="form-control" value="{{$customer->full_name}}" disabled>
                                </div>

                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" class="form-control" value="{{$customer->profile->phone}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <textarea class="form-control" rows="3" disabled>{{$customer->profile->address}}</textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .row -->

    </section><!-- /.content -->
@stop
@section('footerscripts')
    <script src="{{ asset('plugins/fileinput/js/fileinput.min.js') }}"></script>
    <script>
        ckeditor('long');
    </script>
    <script>
        CKEDITOR.replace('short',{
            toolbar:[
                ['Source','-','NewPage','Preview','-','Templates'],
                ['Styles','Format','Font','FontSize'],
                ['TextColor','BGColor'],
            ]
        });
    </script>
    <script>

        var btnCust = '';
        $("#images").fileinput({
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            browseLabel: ' &nbsp;&nbsp;Ảnh đại diện',
            browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert alert-block alert-danger',

            layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif","png"]
        });
    </script>

    <script>
        $("#input-file").fileinput({
            uploadUrl: "http://localhost:8998/shipper/public/admin/public/files/article/",
            uploadAsync: true,
            showUpload: false,
            browseLabel: ' &nbsp;&nbsp;{{Lang::get('fully.select_file')}}',
            previewFileIcon: '<i class="fa fa-file"></i>',
            allowedPreviewTypes: null, // set to empty, null or false to disable preview for all types
            previewFileIconSettings: {
                'doc': '<i class="fa fa-file-word-o text-primary"></i>',
                'xls': '<i class="fa fa-file-excel-o text-success"></i>',
                'ppt': '<i class="fa fa-file-powerpoint-o text-danger"></i>',
                'jpg': '<i class="fa fa-file-photo-o text-warning"></i>',
                'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>',
                'zip': '<i class="fa fa-file-archive-o text-muted"></i>',
                'htm': '<i class="fa fa-file-code-o text-info"></i>',
                'txt': '<i class="fa fa-file-text-o text-info"></i>',
                'mov': '<i class="fa fa-file-movie-o text-warning"></i>',
                'mp3': '<i class="fa fa-file-audio-o text-warning"></i>'
            },
            previewFileExtSettings: {
                'doc': function(ext) {
                    return ext.match(/(doc|docx)$/i);
                },
                'xls': function(ext) {
                    return ext.match(/(xls|xlsx)$/i);
                },
                'ppt': function(ext) {
                    return ext.match(/(ppt|pptx)$/i);
                },
                'zip': function(ext) {
                    return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
                },
                'htm': function(ext) {
                    return ext.match(/(php|js|css|htm|html)$/i);
                },
                'txt': function(ext) {
                    return ext.match(/(txt|ini|md)$/i);
                },
                'mov': function(ext) {
                    return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
                },
                'mp3': function(ext) {
                    return ext.match(/(mp3|wav)$/i);
                }
            }
        });
    </script>
@endsection