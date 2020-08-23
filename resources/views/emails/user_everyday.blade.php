@extends('mailTemplate')

@section('mail-content')
<p>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90">
    <tr>
        <td><table width="650" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
                <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="201"><a href= "{{$homepage}}" target="_blank"><img src="{{url('/images/btc.jpg')}}" width="200" height="46"></a></td>
                                <td width="393">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td height="41" align="right" valign="middle">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="67%" align="right"><font style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#68696a; font-size:11px; text-transform:uppercase"><a href= "{{$login}}" style="color:#68696a; text-decoration:none"><strong>LOGIN</strong></a></font></td>
                                                        <td width="4%">&nbsp;</td>
                                                    </tr>
                                                </table>

                                            </td>
                                        <tr>
                                            <td height="5" bgcolor="#f4821f"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
                <tr>
                    <td align="center">&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="10%">&nbsp;</td>
                                <td width="80%">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="25%"><b>Xin chào:</b></td>
                                            <td width="75%"><b>{{$username}}</b></td>
                                        </tr>
                                        <tr>
                                            <td height="10"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Tỷ giá bitcoin ngày: <b>{{number_format($rate->rate,0,',','.').' '.$rate->code}}</b>/BTC </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td height="2" bgcolor="#959494" width="100%" colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td align="center">Chia sẻ liên kết này để giới thiệu Romanbi cho bạn bè và kiếm được  0.01 BTC</td></tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr><td height="46" valign="center" bgcolor="#fce8d2" align="center"><b><a href="{{$refer}}">{{$refer}}</a></b></td></tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>

                                                    <tr>
                                                        <td align="center" style="color:#f7931b"><a href="{{url($referral_program)}}"> <b>Tìm hiểu thêm</b></a> </td></tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td height="2" bgcolor="#959494" width="100%" colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><font color="#f7931b" size="5"><b>Quảng cáo bán:</b></font></td>
                                        </tr>
                                        @foreach( $userads as $index=>$userad )
                                        <tr>
                                            <td colspan="2" height="46" valign="center">
                                                <font color="#067fb7">{{$usersell[$userad->id]['username']}}</font> - {{$rate->code}} {{number_format($usersell[$userad->id]['price'],0, ',', '.')}} - Chuyển khoản ngân hàng - <a href="{{$buynow}}"><font color="#067fb7"><b>Mua ngay</b></font></a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </table>
                                </td>
                                <td width="10%">&nbsp;</td>
                            </tr>
                        </table></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td height="3px" bgcolor="#f4821f"></td>
                </tr>

                <tr height="31px">
                    <td align="center"><font style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#231f20; font-size:10px"><strong>@Bitcoin - Buy Bitcoin fast and securely</a></strong></font></td>
                </tr>
            </table>
        </td>

    </tr>

</table>

</p>
@endsection
