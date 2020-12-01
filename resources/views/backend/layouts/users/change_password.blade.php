 @extends('backend.layouts.master')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Password</li>
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
                <h3 class="card-title">Change Password</h3>
              </div><!-- /.card-header -->
              <div class="card-body">

                <form action="{{route('profiles.password.update')}}" method="post" id="valideform">
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-4">
                      <label for="old_password">Password</label>
                      <input type="password" class="form-control" id="old_password" name="old_password">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="new_password">Password</label>
                      <input type="password" class="form-control" id="new_password" name="new_password">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="con_password">Confram</label>
                      <input type="password" class="form-control" id="con_password" name="con_password">
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
            old_password: {
                required: true,
            },
            new_password: {
                required: true,
                minlength: 8
            },
            con_password: {
                required:true,
                equalTo: '#new_password'
            },
        },
        messages:{
          old_password:{
            required:"Please old password password",
          },
          new_password:{
            required:"Please enter new password",
            minlength:"Password will be 8 characters or number"
          },
          con_password:{
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