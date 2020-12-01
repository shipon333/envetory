
 @extends('backend.layouts.master')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Customers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Customers</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edit Customers
                </h3>
                <a href="{{route('customers.view')}}" class="btn btn-success float-right"><i class="fa fa-plus-circle">Customers List</i></a>
              </div><!-- /.card-header -->
              <div class="card-body">

                <form action="{{route('customers.update',$edit_customers->id)}}" method="post" id="valideform">
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="name">Suppliers Name</label>
                      <input type="text" class="form-control" value="{{$edit_customers->name}}" id="name" name="name">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="mobile">Mobile</label>
                      <input type="text" class="form-control" value="{{$edit_customers->mobile}}" id="mobile" name="mobile">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" value="{{$edit_customers->email}}" name="email">
                      <font style="color:red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" value="{{$edit_customers->address}}" id="address" name="address">
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">Update</button>
                  </div>
                </form>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
   @endsection