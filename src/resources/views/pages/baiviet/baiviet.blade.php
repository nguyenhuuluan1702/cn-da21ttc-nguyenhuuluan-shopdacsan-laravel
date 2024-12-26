@extends('layout')
@section('content')
<div class="features_items">
                <h2 class="title text-center">{{ $news_title }}</h2>

                <div class="product-image-wrapper" style="border: none;">
                    @foreach($news_test as $key => $p)
                    <div class="single-products" style="margin: 10px 0; padding: 2px;">
                        {!! $p->news_content !!}
                    </div>
                    <div class="clearfix"></div>
                    @endforeach
                </div>
</div><!--features_items-->
@endsection
