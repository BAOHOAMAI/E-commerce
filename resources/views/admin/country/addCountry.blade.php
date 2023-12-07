@extends('admin.layouts.index');

@section ('content')
	<div class="page-wrapper" style="margin-left:20px">
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-body">
                            <h4 class="card-title">ADD COUNTRY</h4>
                            <form method="post" class="form-horizontal m-t-30">
                                @csrf
                                <div class="form-group">
                                    <input name="country" type="text" class="form-control" placeholder="Vui long nhap nuoc">
                                    <button class="btn btn-success" style="margin-top:20px">ADD</button>
                                </div>       
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection