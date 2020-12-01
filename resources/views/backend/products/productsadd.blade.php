
 @extends('backend.layouts.master')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
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
                <h3 class="card-title">Add Product
                </h3>
                <a href="{{route('products.view')}}" class="btn btn-success float-right"><i class="fa fa-plus-circle">Products List</i></a>
              </div><!-- /.card-header -->
              <div class="card-body">

                <form action="{{route('products.store')}}" method="post" id="valideform">
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="supplier_id">Suppliers Name</label>
                      <select name="supplier_id" class="form-control" id="supplier_id">
                          <option value="">Select Supplier</option>
                          @foreach($suppliers as $key=> $supplier)
                          <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="category_id">Categorys Name</label>
                      <select name="category_id" class="form-control" id="category_id">
                          <option value="">Select Category</option>
                          @foreach($categorys as $key=> $categorys)
                          <option value="{{$categorys->id}}">{{$categorys->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="name">Products Name</label>
                      <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="units_id">Units Name</label>
                      <select name="unit_id" class="form-control" id="unit_id">
                          <option value="">Select Category</option>
                          @foreach($units as $key=> $unit)
                          <option value="{{$unit->id}}">{{$unit->name}}</option>
                          @endforeach
                      </select>
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
            supplier_id: {
                required: true
            },
            category_id: {
                required: true
            },
            name: {
                required: true
            },
            unit_id: {
                required: true
            },


        },
        messages:{
          supplier_id:{
            required:"Please Select Supplier name",
          },
          category_id:{
            required:"Please Select Category name",
          },
          name:{
            required:"Please Enter Product name",
          },
          unit_id:{
            required:"Please Select Unit name",
          },
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