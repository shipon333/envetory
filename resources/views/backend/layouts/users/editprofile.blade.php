 @extends('backend.layouts.master')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Profiels</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Profiels</li>
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
                <h3 class="card-title">Edit Profile
                </h3>
                <a href="{{route('profiles.view')}}" class="btn btn-success float-right"><i class="fa fa-plus-circle">Profile</i></a>
              </div><!-- /.card-header -->
              <div class="card-body">
                <font style="color:red">{{($errors->has('image'))?($errors->first('image')):''}}</font>
                <form action="{{route('profiles.update')}}" method="post" id="valideform" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    
                    <div class="form-group col-md-4">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" value="{{$editprofiles->name}}" name="name">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" value="{{$editprofiles->email}}" name="email">
                      <font style="color:red">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="mobile">Mobile</label>
                      <input type="text" class="form-control" id="mobile" value="{{$editprofiles->mobile}}" name="mobile">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" id="address" value="{{$editprofiles->address}}" name="address">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="gender">Gender</label>
                        
                        <select name="gender" id="gender" class="form-control">
                          <option value="">Select Role</option>
                          <option value="Male" {{($editprofiles->gender=="Male")?"selected":""}}>Male</option>
                          <option value="Female" {{($editprofiles->gender=="Female")?"selected":""}}>Female</option>
                        </select>
                      
                    </div>

                    <div class="form-group col-md-4">
                      <label for="image">Image</label>
                      <input type="file" class="form-control" id="image" value="{{$editprofiles->image}}" name="image">
                    </div>
                    <div class="form-group col-md-4">
                      <img src="{{(!empty($editprofiles->image))?url('public/upload/users/'.$editprofiles->image):url('public/upload/download.jpg')}}" id="showimage" alt="" width="300px" height="300px">
                    </div>
                    <div class="form-group col-md-4" style="margin-top: 50px">
                      <button type="submit" class="btn btn-success">Update</button>
                    </div>
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
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
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
          email:{
            required:"Please enter a email address",
            email:"Please enter a <em>vaild</em> email address"
          },
          password:{
            required:"Please provide a password",
            minlength:"Password will be 6 characters or number"
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