@extends('layouts.profiles')

@section('profiles')
    <!-- Main content -->
    <section class="content">
                    <div class="col-md-9">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#taikhoan" data-toggle="tab">Tài khoản</a></li>
                                <li><a href="#profile" data-toggle="tab">Thông tin cá nhân</a></li>
                                <li><a href="#banks" data-toggle="tab">Địa chỉ ngân hàng</a></li>
                                <li><a href="#address" data-toggle="tab">Địa chỉ giao hàng</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="taikhoan">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form role="form" method="POST" action="{{ url('admin/users/'.$user->username) }}">
                                                {!! method_field('PATCH') !!}
                                                {!! csrf_field() !!}
                                                <div class="form-group{{ $errors->has('full_name') ? ' has-error' : ' has-feedback' }}">
                                                    <label for="full_name">{{ trans('VNPCMS.forms.labels.fullname') }}*</label>
                                                    <input type="text" class="form-control" placeholder="{{ trans('VNPCMS.forms.placeholders.namesurname') }}" name="full_name" value="{{ old('full_name') ? old('full_name') : $user->full_name }}" required>
                                                    @if ($errors->has('full_name'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('full_name') }}</strong>
													</span>
                                                    @endif
                                                </div>
                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : ' has-feedback' }}">
                                                    <label for="email">{{ trans('VNPCMS.forms.labels.email') }}*</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                        <input type="email" class="form-control" placeholder="user@email.com" name="email" value="{{ old('email') ? old('email') : $user->email }}" required>
                                                    </div>
                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('email') }}</strong>
													</span>
                                                    @endif
                                                </div>
                                                <div class="form-group{{ $errors->has('user_handle_id') ? ' has-error' : ' has-feedback' }}">
                                                    <label for="user_handle_id">{{ trans('VNPCMS.forms.labels.user_handle_id') }}*</label>
                                                    <div class="input-group">
														{!! Form::select('user_handle_id', ['' => 'Please Select']+$handles, $user->user_handle_id, ['class' => 'form-control select2'])  !!}
                                                    </div>
                                                    @if ($errors->has('user_handle_id'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('user_handle_id') }}</strong>
													</span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('VNPCMS.forms.buttons.save') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- <h4>Change password</h4> -->
                                            <form role="form" id="editPasswordForm" method="POST" action="{{ url('admin/users/'.$user->username.'/password') }}">
                                                {!! method_field('PATCH') !!}
                                                {!! csrf_field() !!}
                                                <div class="form-group{{ $errors->has('password') ? ' has-error' : ' has-feedback' }}">
                                                    <label for="password">{{ trans('VNPCMS.forms.labels.newpassword') }}*</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                        <input type="password" class="form-control" name="password" value="" required>
                                                    </div>
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('password') }}</strong>
													</span>
                                                    @endif
                                                </div>
                                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : ' has-feedback' }}">
                                                    <label for="password_confirmation">{{ trans('VNPCMS.forms.labels.confirmnewpassword') }}*</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                        <input type="password" class="form-control" name="password_confirmation" value="" required>
                                                    </div>
                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('password_confirmation') }}</strong>
													</span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('VNPCMS.forms.buttons.change') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="profile">
                                    <form role="form" method="POST" action="{{ url('admin/profiles/'.$user->username) }}">
                                        {!! method_field('PATCH') !!}
                                        {!! csrf_field() !!}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('birthday') ? ' has-error' : ' has-feedback' }}">
                                                    <label for="birthday">{{ trans('VNPCMS.forms.labels.birthday') }}*</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right datepicker" name="birthday" value="{{ old('birthday') ? old('birthday') : $user->profile->birthday }}" required/>
                                                    </div>

                                                    @if ($errors->has('birthday'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('birthday') }}</strong>
													</span>
                                                    @endif
                                                </div>
                                                <div class="form-group{{ $errors->has('gender') ? ' has-error' : ' has-feedback' }}">
                                                    <label for="gender">{{ trans('VNPCMS.forms.labels.gender') }}*</label>
                                                    <br />
                                                    <input type="radio" class="minimal" id="gender" name="gender" value="male" {{ old('gender') == 'male' ? "checked" : ($user->profile->gender == 'male' ? 'checked' : "") }} /> {{ trans('VNPCMS.forms.checkboxes.male') }}
                                                    <input type="radio" class="minimal" id="gender" name="gender" value="female" {{ old('gender') == 'female' ? "checked" : ($user->profile->gender == 'female' ? 'checked' : "") }} /> {{ trans('VNPCMS.forms.checkboxes.female') }}
                                                    <input type="radio" class="minimal" id="gender" name="gender" value="other" {{ old('gender') == 'other' ? "checked" : ($user->profile->gender == 'other' ? 'checked' : "") }} /> {{ trans('VNPCMS.forms.checkboxes.other') }}

                                                    @if ($errors->has('gender'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('gender') }}</strong>
													</span>
                                                    @endif
                                                </div>
                                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : ' has-feedback' }}">
                                                    <label for="phone">{{ trans('VNPCMS.forms.labels.phone') }}</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                        <input type="text" class="form-control" placeholder="+1 555 555 555" name="phone" value="{{ old('phone') ? old('phone') : $user->profile->phone }}"/>
                                                    </div>
                                                    @if ($errors->has('phone'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('phone') }}</strong>
													</span>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('website') ? ' has-error' : ' has-feedback' }}">
                                                    <label for="website">{{ trans('VNPCMS.forms.labels.website') }}</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                                        <input type="text" class="form-control" placeholder="http://example.com" name="website" value="{{ old('website') ? old('website') : $user->profile->website }}" />
                                                    </div>

                                                    @if ($errors->has('website'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('website') }}</strong>
													</span>
                                                    @endif
                                                </div>
                                                <br />
                                                <label>Mạng xã hội:</label>

                                                <div class="form-group{{ $errors->has('facebook_username') ? ' has-error' : ' has-feedback' }}">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-facebook-official"></i></span>
                                                        <input type="text" class="form-control" placeholder="Tài khoản Facebook" name="facebook_username" value="{{ old('facebook_username') ? old('facebook_username') : $user->profile->facebook_username }}" />
                                                    </div>
                                                    @if ($errors->has('facebook_username'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('facebook_username') }}</strong>
													</span>
                                                    @endif
                                                </div>
                                                <div class="form-group{{ $errors->has('google_username') ? ' has-error' : ' has-feedback' }}">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-google-plus"></i></span>
                                                        <input type="text" class="form-control" placeholder="Tài khoản Google+" name="google_username" value="{{ old('google_username') ? old('google_username') : $user->profile->google_username }}" />
                                                    </div>
                                                    @if ($errors->has('twitter_username'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('google_username') }}</strong>
													</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <br style="clear:both;">
                                            <br style="clear:both;">
                                            <div class="col-md-12">
                                                <div class="form-group{{ $errors->has('address') ? ' has-error' : ' has-feedback' }}">
                                                    <label for="address">Địa chỉ</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                                        <input type="text" class="form-control" placeholder="Địa chỉ" name="address" value="{{ old('address') ? old('address') : $user->profile->address }}" />
                                                    </div>
                                                    @if ($errors->has('address'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('address') }}</strong>
													</span>
                                                    @endif
                                                </div>

                                                <div class="form-group{{ $errors->has('city') ? ' has-error' : ' has-feedback' }}">
                                                    <label for="address">Tỉnh/Thành phố</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                                        <input type="text" class="form-control" placeholder="Tỉnh/Thành phố" name="city" value="{{ old('city') ? old('city') : $user->profile->city }}" />
                                                    </div>
                                                    @if ($errors->has('city'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('city') }}</strong>
													</span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('biography') ? ' has-error' : ' has-feedback' }}">
                                                    <label for="biography">Ghi chú</label>

                                                    <div class="box-body pad">
                                                        <textarea class="form-control wysitextarea" id="biography" rows="15" placeholder="{{ trans('VNPCMS.forms.placeholders.entertexthere') }}" type="text" name="biography" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required/>{{ old('biography') ? old('biography') : $user->profile->biography }}</textarea>
                                                    </div>
                                                    @if ($errors->has('biography'))
                                                        <span class="help-block">
														<strong>{{ $errors->first('biography') }}</strong>
													</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <br style="clear:both;">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{ trans('VNPCMS.forms.buttons.save') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="banks">

                                    <div class="box">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Danh sách tài khoản</h3>
                                        </div>
                                        <div class="box-body">
                                            <br style="clear:both;">
                                            <br style="clear:both;">

                                            <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Số tài khoản</th>
                                                    <th>Tên tài khoản</th>
                                                    <th>Chi nhánh</th>
                                                    <th>Ngân hàng</th>
                                                    <th>Trạng thái</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($user->banks()->get() as $bank )
                                                    <tr>
                                                        <td>{{ $bank->banknumber }}</td>
                                                        <td>{{ $bank->accountbank }}</td>
                                                        <td>{{ $bank->branch }}</td>
                                                        <td>{{ $bank->cates->name }}</td>
                                                        <td>
                                                            @if($bank->status==1)
                                                                Sử dụng
                                                            @else
                                                                Ngừng sử dụng
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->

                                    <div class="box">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Thêm mới tài khoản ngân hàng</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <form role="form" action="{{ url('admin/banks/create') }}" method="POST" enctype="multipart/form-data">
                                            {!! csrf_field() !!}
                                            <div class="box-body">
                                                <div class="col-md-12">

                                                    <div class="form-group">
                                                        <label for="title">Ngân hàng</label>
                                                        <select class="form-control" name="categories">
                                                            @foreach($cates as $value)
                                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="title">Số tài khoản</label>
                                                        <input type="text" name="banknumber" class="form-control" id="banknumber">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="title">Tên tài khoản</label>
                                                        <input type="text" name="accountbank" class="form-control" id="accountbank">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="title">Chi nhánh</label>
                                                        <input type="text" name="branch" class="form-control" id="branch">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="title">{{ trans('VNPCMS.forms.labels.order') }}</label>
                                                        <input type="number" name="order" class="form-control" id="order" value="1" min="1">
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="hidden" name="customer_id" class="form-control" id="customer_id" value="{{$user->id}}">
                                                    </div>

                                                    <!-- /.box-body -->
                                                    <div class="box-footer" align="center">
                                                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>





                                </div>
                                <!-- /.tab-pane -->


                                <div class="tab-pane" id="address">

                                    <div class="box">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Danh sách địa chỉ giao hàng</h3>
                                        </div>
                                        <div class="box-body">
                                            <table id="allnewstable" class="table table-responsive table-bordered table-hover table-striped">
                                                <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Người nhận</th>
                                                    <th>Điện thoại</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Tỉnh/Thành phố</th>
                                                    <th>Trạng thái</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($user->address()->get() as $key=>$add)
                                                    <tr>
                                                        <td>{{ $key=1 }}</td>
                                                        <td>{{ $add->receiver_user }}</td>
                                                        <td>{{ $add->phone }}</td>
                                                        <td>{{ $add->address }}</td>

                                                        <td>{{ $add->cates->name }}</td>
                                                        <td>
                                                            @if($add->is_primary==1)
                                                                Chính thức
                                                            @else
                                                                Dự phòng
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <div class="modal fade" tabindex="-1" role="dialog" id="confirmProductsDelete">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                                </button>
                                                                <h4 class="modal-title">{{ trans('VNPCMS.pages.subtitles.confirmproductsdeletion') }}</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>{{ trans('VNPCMS.forms.help.areyousure') }} <b><span id="productname"></span></b>?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{{ trans('VNPCMS.forms.buttons.close') }}</button>
                                                                {!! Form::open(['method' => 'DELETE', 'id'=>'delForm']) !!}
                                                                <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('VNPCMS.forms.buttons.delete') }}</button>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                </div>
                                                </tbody>
                                            </table>

                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->

                                    <div class="box">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Thêm mới địa chỉ</h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <form role="form" action="{{ url('admin/members/address/create') }}" method="POST" enctype="multipart/form-data">
                                            {!! csrf_field() !!}
                                            <div class="box-body">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label for="title">Người nhận hàng</label>
                                                            <input type="text" name="receiver_user" class="form-control" id="receiver_user">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="title">Điện thoại nhận hàng</label>
                                                            <input type="text" name="phone" class="form-control" id="phone">
                                                        </div>
                                                        <label for="title">Địa chỉ giao hàng</label>
                                                        <input type="text" name="address" class="form-control" id="address">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="title">Tỉnh/Thành phố</label>
                                                        <select class="form-control select2" name="city" id="city" style="width: 100%">
                                                            <option value="0">Lựa chọn tỉnh thành phố</option>
                                                            @foreach($cities as $value)
                                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="title">Chế độ</label>
                                                        <select class="form-control" name="is_primary" id="is_primary">
                                                            <option value="0">Dự phòng</option>
                                                            <option value="1">Chính thức</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="hidden" name="customer_id" class="form-control" id="customer_id" value="{{$user->id}}">
                                                    </div>
                                                    <!-- /.box-body -->
                                                    <div class="box-footer" align="center">
                                                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                </div>
                                <!-- /.tab-pane -->

                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
    </section><!-- /.content -->
@stop