@extends('themes.products')
@section('page_title')
Trang chủ
@endsection
@section('main-content')
    <div class="list-col-right">
        <div class="list-products">
            <div class="row">
@foreach($listproducts as $key=>$list)
                    <div class="col-5">
                        <div class="grid-item hot-product">
                            <div class="item-box">
                                <div class="cover"><a href="{{url($list->slug)}}"><img src="{{asset('public/images/products/'.$list->model.'/'.$list->images)}}" alt="{{$list->name}}" class="imgresponsive"></a></div>
                                <div class="info-product">
                                    <div class="info-color">
                                        <div class="number-of-colors"> <a href="{{url($list->slug)}}">{{$list->name}}</a></div>
                                    </div>
                                    <h3><a href="{{url($list->slug)}}">Mã sản phẩm: {{$list->code}}</a></h3>
                                    <div class="price"><span>Giá bán: {{number_format($list->price,'0',',','.')}}</span><span class="old">(Chưa bao gồm VAT)</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
@endforeach
            </div>
        </div>
        @if($page=='list')
        <div align="center">
            {!! $listproducts->render() !!}
        </div>
            @endif

        @if($page=='order')
            <div align="center">
                {!! $listproducts->appends([$page => $curl])->render() !!}
            </div>
        @endif

        @if($page=='seach')
            <div align="center">
                @if($pageSize!=null && $pageColor==null)
                {!! $listproducts->appends(['seach' => 'true','size'=>$pageSize])->render() !!}
                @endif

                    @if($pageSize==null && $pageColor!=null)
                        {!! $listproducts->appends(['seach' => 'true','color'=>$pageColor])->render() !!}
                    @endif

                    @if($pageSize!=null && $pageColor!=null)
                        {!! $listproducts->appends(['seach' => 'true','size'=>$pageSize,'color'=>$pageColor])->render() !!}
                    @endif
            </div>
        @endif


    </div><!-- /.list-col-right -->
@endsection
@section('page-script')
@endsection