@extends('themes.articles')
@section('page_title')
Trang chủ
@endsection
@section('main-content')
    <div class="container">
        <h2 class="pageTitle lTitle">Thanh toán</h2>
        <div class="page-detail">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <h2 class="mTitle">Phương thức thanh toán</h2>
                    <div class="nike-cq-table table-text-normal">
                        <table cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <th width="55%"></th>
                                <th>Thường</th>
                                <th>VIP</th>
                                <th>Super VIP</th>
                            </tr>

                            <tr class="table-row-white">
                                <td>Chuyển khoản qua ngân hàng</td>
                                <td><i class="fa fa-check"></i></td>
                                <td><i class="fa fa-check"></i></td>
                                <td><i class="fa fa-check"></i></td>
                            </tr>
                            <tr class="table-row-white">
                                <td>Thanh toán tiền mặt khi nhận hàng (COD)</td>
                                <td></td>
                                <td><i class="fa fa-check"></i></td>
                                <td><i class="fa fa-check"></i></td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!--/.tab-content-->

                    <h2 class="mTitle">Về đặt cọc (VNĐ)</h2>
                    <div class="nike-cq-table table-text-normal">
                        <table cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <th width="55%"></th>
                                <th>Thường</th>
                                <th>VIP</th>
                                <th>Super VIP</th>
                            </tr>

                            <tr>
                                <td>Đơn hàng ≤ 2.000.000 đ</td>
                                <td>500.000</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr class="table-row-white">
                                <td>Đơn hàng ≤ 5.000.000 đ</td>
                                <td>1.000.000</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>Đơn hàng > 5.000.000 đ</td>
                                <td>Thỏa thuận</td>
                                <td>Thỏa thuận</td>
                                <td>0</td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!--/.tab-content-->

                    <h2 class="mTitle">Tài khoản ngân hàng BF365</h2>
                    <div class="nike-cq-table table-text-normal">
                        <table cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <th>Ngân hàng</th>
                                <th>Số tài khoản</th>
                                <th>Chi nhánh</th>
                                <th>Chủ tài khoản</th>
                            </tr>

                            <tr>
                                <td>Vietcombank</td>
                                <td>0011004329504</td>
                                <td>Sở giao dịch (HN)</td>
                                <td>Ta Mac Thong</td>
                            </tr>
                            <tr class="table-row-white">
                                <td>BIDV</td>
                                <td>12510001026761</td>
                                <td>Đông Đô (HN)</td>
                                <td>Ta Mac Thong</td>
                            </tr>
                            <tr>
                                <td>Viettinbank</td>
                                <td>100004630814 </td>
                                <td>Ba Đình (HN)</td>
                                <td>Ta Mac Thong</td>
                            </tr>

                            </tbody>
                        </table>
                    </div><!--/.tab-content-->

                    <div class="note-for-this">
                        <h2 class="mTitle">Lưu ý</h2>
                        <ul class="list-dotstyle">
                            <li>Nội dung thanh toán khi chuyển khoản, ghi rõ ("Tên tài khoản tại BF365 + số điện thoại liên hệ")</li>
                            <li>Phí COD do khách hàng thanh toán khi nhận hàng.</li>
                        </ul>
                    </div>

                </div><!--/.col-9-->
                <div class="col-sm-1"></div>
            </div><!-- /.row-->
        </div><!-- /.page-detail -->
    </div><!-- /.container -->
@endsection
@section('page-script')
@endsection