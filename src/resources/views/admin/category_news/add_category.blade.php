@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm danh mục bài viết
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
                                <form role="form" action="{{URL::to('/save-category-news')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục bài viết</label>
                                    <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập tên thương hiệu" name="cate_news_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="cate_news_slug" class="form-control" id="exampleInputEmail1" placeholder="Slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục bài viết</label>
                                    <textarea style="resize: none" rows="8" class="form-control" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng mô tả thương hiệu" name="cate_news_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="cate_news_status" class="form-control input-sm m-bot15">
                                            <option value="1">Ẩn</option>
                                            <option value="0">Hiển thị</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_news_cate" class="btn btn-info">Thêm danh mục</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection