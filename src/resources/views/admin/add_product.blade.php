@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm sản phẩm
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
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập tên sản phẩm" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                                    <input type="text" data-validation="number" data-validation-error-msg="Làm ơn điền số lượng" name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Điền số lượng">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng đã bán</label>
                                    <input type="text" data-validation="number" data-validation-error-msg="Làm ơn điền số lượng" name="product_sold" class="form-control" id="exampleInputEmail1" placeholder="Điền số lượng">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="product_slug" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div> -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá gốc</label>
                                    <input type="text" data-validation="number" data-validation-error-msg="Vui lòng nhập số tiền" name="product_von" class="form-control" id="product_von" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá bán</label>
                                    <input type="text" readonly="true" data-validation="number" data-validation-error-msg="Vui lòng nhập số tiền" name="product_price" class="form-control" id="product_price" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" data-validation="required" 
                                    data-validation-error-msg="Vui lòng chọn hình ảnh sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none"  rows="8" class="form-control" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng mô tả sản phẩm"  name="product_desc" id="ckeditor1" placeholder="Mô tả sản phẩm"></textarea>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows="8" class="form-control" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng nhập nội dung sản phẩm" name="product_content"  id="editor3" placeholder="Nội dung sản phẩm"></textarea>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                      <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu</label>
                                      <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="product_status" class="form-control input-sm m-bot15">
                                            <option value="0">Hiển thị</option>
                                            <option value="1">Ẩn</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection