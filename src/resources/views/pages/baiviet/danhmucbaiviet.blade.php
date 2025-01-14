@extends('layout')
@section('slide')
@include('pages.include.slide')
@endsection
@section('content')
    <div class="features_items"><!--features_items-->
        
        <h2 class="title text-center">{{$cate_news_name}}</h2>
        
        <div class="product-image-wrapper2">
            @foreach($news as $key => $p)                                      
            <div class="single-products" style="margin: 10px 0; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background-color: #f9f9f9;">
                <div class="d-flex">
                    <img style="float: left; width: 30%; margin-right: 15px; height: 160px; object-fit: cover; border: 2px solid #ccc; border-radius: 5px;" 
                        src="{{URL::to('public/uploads/news/'.$p->news_image)}}" 
                        alt="{{ $p->news_slug }}" />
                        
                    <div style="overflow: hidden; text-align: left;">
                        <h4 style="color: #000; margin-bottom: 10px;">{{ $p->news_title }}</h4>
                        <p style="color: #555;">{!! $p->news_desc !!}</p>
                    </div>
                </div>
                <div class="text-right" style="margin-top: 10px;">
                    <a href="{{url('/bai-viet/'.$p->news_slug)}}" class="btn btn-default btn-sm">Xem bài viết</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="pagination justify-content-center">
        {{ $news->links() }}
    </div>
        
    </div><!--features_items-->
@endsection
