@extends('backend.master.master')
@section('title','Sửa giá trị thuộc tính')
@section('product')
	class="active";
@endsection	
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Danh mục/Thuộc tính/Sửa giá trị của tính</li>
		</ol>
	</div>
	<!--/.row-->


	<!--/.row-->
	<div class="row col-md-offset-3 ">
		<div class="col-md-6">	
		<div class="panel panel-blue">
			<div class="panel-heading dark-overlay">Sửa giá trị của tính</div>
			<form action="" method="POST">@csrf 
				<div class="panel-body">
					<div class="form-group">
					<label for="">Tên giá trị của thuộc tính</label>
					<input type="text" name="edit_value_name" id="" class="form-control" placeholder="" aria-describedby="helpId" value="{{ $value->value }}">
				
					</div>
					<div  align="right"><button class="btn btn-success" type="submit">Sửa</button></div>
				</div>
			</form>
		</div>
		{{ ShowErrors($errors,'edit_value_name') }}
		@if (session('thongbao'))
		<div class="alert bg-success" role="alert">
			<svg class="glyph stroked checkmark">
				<use xlink:href="#stroked-checkmark"></use>
			</svg>{{ session('thongbao') }}<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>
		@endif
										
		</div>
		<!--/.col-->
	</div>
	<!--/.row-->
</div>
@endsection