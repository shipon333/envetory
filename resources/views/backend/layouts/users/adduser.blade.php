
 @extends('backend.layouts.master')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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
                <h3 class="card-title">Add User
                </h3>
                <a href="{{route('user.view')}}" class="btn btn-success float-right"><i class="fa fa-plus-circle">User List</i></a>
              </div><!-- /.card-header -->
              <div class="card-body">

                <form action="{{route('user.store')}}" method="post" id="valideform">
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-4">
                      <label for="usertype">User Type</label>
                        
                        <select name="usertype" id="usertype" class="form-control">
                          <option value="">Select Role</option>
                          <option value="Admin">Admin</option>
                          <option value="User">User</option>
                        </select>
                      
                    </div>
                    <div class="form-group col-md-4">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email">
                      <font style="color:red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="password2">Confram</label>
                      <input type="password" class="form-control" id="password2" name="password2">
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-success">Submit</button>
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