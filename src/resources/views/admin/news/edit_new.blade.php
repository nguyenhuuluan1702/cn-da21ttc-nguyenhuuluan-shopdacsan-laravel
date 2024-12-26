@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật bài viết
                        </header>
                         <?php                      
                            use Illuminate\Support\Facades\Session;
            
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-news', $news->news_id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên bài viết</label>
                                    <input type="text" data-validation="length" data-validation-length="min1" 
                                    data-validation-error-msg="Vui lòng nhập tên thương hiệu" name="news_title" class="form-control" value="{{$news->news_title}}" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="news_slug" class="form-control" value="{{$news->news_slug}}" id="exampleInputEmail1" placeholder="Slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                                    <textarea style="resize: none" rows="8" class="form-control" data-validation="length" data-validation-length="min1" 
                                    data-validation-error-msg="Vui lòng mô tả thương hiệu" name="news_desc" id="editor" placeholder="Mô tả danh mục">{{$news->news_desc}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung bài viết</label>
                                    <textarea style="resize: none" rows="8" class="form-control" data-validation="length" data-validation-length="min1" 
                                    data-validation-error-msg="Vui lòng mô tả thương hiệu" name="news_content" id="editor1" placeholder="Mô tả danh mục">{{$news->news_content}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                                    <input type="file" name="news_image" class="form-control" id="" >
                                    <img src="{{URL::to('public/uploads/news/'.$news->news_image)}}" height="100" width="100">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục bài viết</label>
                                    <select name="cate_news_id" class="form-control input-sm m-bot15">
                                        @foreach($cate_news as $key => $cate)
                                            <option {{ $cate->cate_news_id==$cate->cate_news_id ? 'selected':'' }} 
                                                value="{{ $cate->cate_news_id}}">{{ $cate->cate_news_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="news_status" class="form-control input-sm m-bot15">
                                        @if($news->news_status==0)
                                            <option selected value="0">Hiển thị</option>
                                            <option value="1">Ẩn</option>
                                        @else
                                            <option value="0">Hiển thị</option>
                                            <option selected value="1">Ẩn</option>
                                        @endif
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_new" class="btn btn-info">Cập nhật bài viết</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection