@extends('backend.master.master')
@section('title','Sửa sản phẩm')
@section('product')
	class="active";
@endsection
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sửa sản phẩm</h1>
        </div>
    </div>
    <!--/.row-->
    <form method="POST" enctype="multipart/form-data">@csrf
        <div class="row">
            <div class="col-xs-6 col-md-12 col-lg-12">
            
                    <div class="panel panel-primary">
                        <div class="panel-heading">Sửa sản phẩm {{ $product->name }} ({{ $product->product_code }})</div>
                        @if (session('thongbao'))
								<div class="alert bg-success" role="alert">
									<svg class="glyph stroked checkmark">
										<use xlink:href="#stroked-checkmark"></use>
									</svg>{{ session('thongbao') }}<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
								</div>
							@endif
                        <div class="panel-body">
                            <div class="row" style="margin-bottom:40px">
                                <div class="col-xs-8">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Danh mục</label>
                                                <select name="category" class="form-control">
                                                    {{ GetCategory($category,0,'',$product->category_id) }}
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Mã sản phẩm</label>
                                                <input  type="text" name="product_code" class="form-control"
                                                    value="{{ $product->product_code }}">
                                                {{ ShowErrors($errors,'product_code') }}
                                            </div>
                                            <div class="form-group">
                                                <label>Tên sản phẩm</label>
                                                <input  type="text" name="product_name" class="form-control"
                                                    value="{{ $product->name }}">
                                                    {{ ShowErrors($errors,'product_name') }}
                                            </div>
                                            <div class="form-group">
                                                <label>Giá sản phẩm (Giá chung)</label> <a href="/admin/product/edit-variant/{{ $product->id }}"><span
                                                        class="glyphicon glyphicon-chevron-right"></span>
                                                    Giá theo biến thể</a>
                                                <input  type="number" name="product_price" class="form-control"
                                                    value="{{ $product->price }}">
                                                    {{ ShowErrors($errors,'product_price') }}
                                            </div>
                                            <div class="form-group">
                                                <label>Sản phẩm có nổi bật</label>
                                                <select name="featured" class="form-control">
                                                    <option @if($product->featured==0) selected @endif  value="0">Không</option>
                                                    <option @if($product->featured==1) selected @endif  value="1">Có</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Trạng thái</label>
                                                <select  name="product_state" class="form-control">
                                                    <option @if($product->state==1) selected @endif  value="1">Còn hàng</option>
                                                    <option @if($product->state==0) selected @endif  value="0">Hết hàng</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Ảnh sản phẩm</label>
                                                <input id="img" type="file" name="product_img" class="form-control hidden"
                                                    onchange="changeImg(this)">
                                                    {{ ShowErrors($errors,'product_img') }}
                                                <img id="avatar" class="thumbnail" width="100%" height="350px" src="/backend/img/{{ $product->img }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Thông tin</label>
                                        <textarea  name="info" style="width: 100%;height: 100px;">{{ $product->info }}</textarea>
                                        <script src={{ url('/ckeditor/ckeditor.js') }}></script>
                                        <script>CKEDITOR.replace( 'info');</script>
                                    </div>
            

            </div>
            <div class="col-xs-4">

                <div class="panel panel-default">
                    <div class="panel-body tabs">
                        <label>Các thuộc Tính </label>
                                {{ ShowErrors($errors,'pro_name') }}
                                {{ ShowErrors($errors,'var_name') }}
                        
                        <ul class="nav nav-tabs">
                            @php
                                $i=0;
                            @endphp
                            @foreach ($attrs as $row)
                                <li @if ($i==0) class='active' @endif ><a href="#tab{{ $row->id }}" data-toggle="tab">{{ $row->name }}</a></li>
                                @php
                                    $i=1;
                                @endphp    
                            @endforeach
                           
                        </ul>
                        <div class="tab-content">
                            @foreach ($attrs as $row)
                                <div class="tab-pane fade @if($i==1) active @endif  in" id="tab{{ $row->id }}">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                @foreach ($row->values as $item)
                                                    <th>{{ $item->value }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($row->values as $item)
                                                    <td> <input @if(check_value($product,$item->id)) checked @endif class="form-check-input" type="checkbox" name="attr[{{ $row->id }}][]" value="{{ $item->id }}"> </td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    
                                </div>
                                @php
                                    $i=2;
                                @endphp
                            @endforeach
                            
                            <div class="tab-pane fade  in" id="tab18">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Đỏ</th>
                                            <th>đen</th>
                                            <th>xám</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> <input class="form-check-input" type="checkbox" name="attr[18][62]"
                                                    value="62"> </td>
                                            <td> <input class="form-check-input" type="checkbox" name="attr[18][63]"
                                                    value="63"> </td>
                                            <td> <input class="form-check-input" type="checkbox" name="attr[18][65]"
                                                    value="65"> </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                
                            </div>


                            <div class="tab-pane fade" id="tab-add">
                                <form action="/admin/product/add-attr" method="post"> @csrf 
                                <div class="form-group">
                                    <label for="">Tên thuộc tính mới</label>
                                    <input type="text" class="form-control" name="pro_name"
                                        aria-describedby="helpId" placeholder="">
                                </div>

                                <button type="submit" name="add_pro" class="btn btn-success"> <span
                                        class="glyphicon glyphicon-plus"></span>
                                    Thêm thuộc tính</button>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">

                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <p></p>

                        </label>
                    </div>
                </div>

            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Miêu tả</label>
                            <textarea id="editor"  name="description" style="width: 100%;height: 100px;">{{ $product->describe }}</textarea>
                            <script src={{ url('/ckeditor/ckeditor.js') }}></script>
                            <script>CKEDITOR.replace( 'description');</script>
                        </div>


                        <button class="btn btn-success" name="add-product" type="submit">Sửa sản phẩm</button>
                        <button class="btn btn-danger" type="reset">Huỷ bỏ</button>

                    </div>

                </div>
            </div>

        </div>
    </form>

    <div class="clearfix"></div>
</div>
</div>
</div>
</div>

<!--/.row-->

</div>
@endsection

@section('script')
    @parent
    <script>

        function changeImg(input) {
            //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                //Sự kiện file đã được load vào website
                reader.onload = function (e) {
                    //Thay đổi đường dẫn ảnh
                    $('#avatar').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).ready(function () {
            $('#avatar').click(function () {
                $('#img').click();
            });
        });

    </script>
@endsection
    