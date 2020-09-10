@extends('backend.master.master')
@section('title','Thông tin thành viên')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thông tin thành viên</h1>
            </div>
        </div>
        <!--/.row-->
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fas fa-user"></i> Thành viên - {{Auth::User()->full}}</div>
                    <div class="panel-body">
                        @if (session('thongbao'))
                            <div class="alert alert-success" role="alert">
                                <strong>{{ session('thongbao') }}</strong>
                            </div>
                        @endif
                        <form  method="post">@csrf 
                            <div class="row justify-content-center" style="margin-bottom:40px">

                                <div class="col-md-8 col-lg-8 col-lg-offset-2">
                                
                                    <div class="form-group">
                                        <label>Email</label>
                                        <p>{{Auth::User()->email}}</p>
                                        <p>{{Auth::User()->id}}</p>
                                        
                                    </div>
                                    {{showErrors($errors,'email')}}
                                    <div class="form-group">
                                        <label>password</label>
                                        <input type="text" name="password" class="form-control" value="{{Auth::User()->password}}">
                                    </div>
                                    {{showErrors($errors,'password')}}
                                    <div class="form-group">
                                        <label>Full name</label>
                                        <input type="full" name="full" class="form-control" value="{{Auth::User()->full}}">
                                    </div>
                                    {{showErrors($errors,'full')}}
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="address" name="address" class="form-control" value="{{Auth::User()->address}}">
                                    </div>
                                    {{showErrors($errors,'address')}}
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="phone" name="phone" class="form-control" value="{{Auth::User()->phone}}">
                                    </div>
                                    {{showErrors($errors,'phone')}}
                                
                                    <div class="form-group">
                                        <label>Level</label>
                                        <p>
                                            <?php if (Auth::User()->level==1){
                                                echo 'Admin';
                                            }
                                            else {
                                                echo 'User';
                                            } 
                                        ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 col-lg-8 col-lg-offset-2 text-right">
                                    
                                        <button class="btn btn-success"  type="submit">Cập nhập thông tin</button>
                                        <button class="btn btn-danger" type="reset">Huỷ bỏ</button>
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
