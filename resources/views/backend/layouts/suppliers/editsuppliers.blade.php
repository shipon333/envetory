
 @extends('backend.layouts.master')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Suppliers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Suppliers</li>
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
                <h3 class="card-title">Edit Supplier
                </h3>
                <a href="{{route('suppliers.view')}}" class="btn btn-success float-right"><i class="fa fa-plus-circle">Suppliers List</i></a>
              </div><!-- /.card-header -->
              <div class="card-body">

                <form action="{{route('suppliers.update',$edit_supplier->id)}}" method="post" id="valideform">
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="name">Suppliers Name</label>
                      <input type="text" class="form-control" value="{{$edit_supplier->name}}" id="name" name="name">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="mobile">Mobile</label>
                      <input type="text" class="form-control" value="{{$edit_supplier->mobile}}" id="mobile" name="mobile">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" value="{{$edit_supplier->email}}" name="email">
                      <font style="color:red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" value="{{$edit_supplier->address}}" id="address" name="address">
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
  <script type="text/javascript">
     $(document).ready(function(){
       $('#valideform').validate({
        rules: {
            usertype: {
                required: true
            },
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
            password2: {
                required:true,
                equalTo: '#password'
            },
        },
        messages:{
          usertype:{
            required:"Please select user type",
          },
          name:{
            required:"Please Enter your name",
          },
          email:{
            required:"Please enter a email address",
            email:"Please enter a <em>vaild</em> email address"
          },
          password:{
            required:"Please provide a password",
            minlength:"Password will be 8 characters or number"
          },
          password2:{
            required:"Please enter confram password",
            equalTo:"confram password does not match"
          }
        },
        errorElement:'span',
        errorPlacement:function(error, element){
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error)
        },
        highlight:function(element, errorClass, validClass){
          $(element).addClass('is-invalid');
        },
        unhighlight:function(element, errorClass, validClass){
          $(element).removeClass('is-invalid');
        }
    });

    });
  </script>
   @endsection