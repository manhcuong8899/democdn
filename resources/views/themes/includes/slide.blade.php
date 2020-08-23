<div class="section-slider">

    <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @foreach($viewimages['slide'] as $key=>$img)
                <li data-target="#myCarousel" data-slide-to="{{$key}}"  @if($key==0)
                    class="active"
                        @endif></li>
            @endforeach
        </ol>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            @foreach($viewimages['slide'] as $key=>$img)
                <div class="item
            @if($key==0)
            active
            @endif
                        ">
                    <div class="cover"><a href="{{url($img->url)}}" style="text-decoration: none"><img src="{{asset('public/images/images/'.$img->cates->code.'/'.$img->images)}}" alt="{{$img->name}}" class="rev-slidebg"></a></div>
                </div>
            @endforeach
        </div>
    </div>

</div><!-- /.section-slider -->
