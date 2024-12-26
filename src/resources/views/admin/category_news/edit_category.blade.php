@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật danh mục bài viết
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
                                <form role="form" action="{{URL::to('/update-category-news/'.$category_news->cate_news_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục bài viết</label>
                                    <input type="text" value="{{$category_news->cate_news_name}}" name="cate_news_name" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text"  value="{{$category_news->cate_news_slug}}" name="cate_news_slug" class="form-control" id="exampleInputEmail1" placeholder="Slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục bài viết</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="cate_news_desc" 
                                    id="exampleInputPassword1" >{{$category_news->cate_news_desc}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="cate_news_status" class="form-control input-sm m-bot15">
                                        @if($category_news->cate_news_status==0)
                                            <option value="1">Ẩn</option>
                                            <option selected value="0">Hiển thị</option>
                                        @else
                                            <option value="0">Hiển thị</option>
                                            <option selected value="1">Ẩn</option>    
                                        @endif
                                    </select>
                                </div>

                                <button type="submit" name="update_news_cate" class="btn btn-info">Cập nhật</button>
                                </form>
                            </div>
                          
                        </div>
                    </section>

            </div>
@endsection