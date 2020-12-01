
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
                <h3 class="card-title">Edit Products
                </h3>
                <a href="{{route('products.view')}}" class="btn btn-success float-right"><i class="fa fa-plus-circle">Products List</i></a>
              </div><!-- /.card-header -->
              <div class="card-body">

                <form action="{{route('products.update',$editData->id)}}" method="post" id="valideform">
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label for="supplier_id">Supplier Name</label>
                        <select name="supplier_id" id="supplier_id" class="form-control">
                            <option value="">Select Supplier</option>
                              @foreach($suppliers as $supplier)
                                    <option value="{{$supplier->id}}" {{($editData->supplier_id==$supplier->id)?"selected":''}}>{{$supplier->name}}</option>
                              @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="category-id">Catagory Name</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select Category</option>
                              @foreach($categorys as $category)
                                    <option value="{{$category->id}}" {{($editData->category_id==$category->id)?"selected":''}}>{{$category->name}}</option>
                              @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="name">Product Name</label>
                      <input type="text" class="form-control" value="{{$editData->name}}" id="name" name="name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="unit_id" >Unit Name</label>
                        <select name="unit_id" id="unit_id" class="form-control">
                            <option value="">Select Unit</option>
                              @foreach($units as $unit)
                                    <option value="{{$unit->id}}" {{($editData->unit_id==$unit->id)?"selected":''}}>{{$unit->name}}</option>
                              @endforeach
                        </select>
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
            supplier_id: {
                required: true
            },
            category_id: {
                required: true,
            },
            name: {
                required:true,
            },
            unit_id: {
                required:true,
            },
        },
        messages:{
          supplier_id:{
            required:"Please Select the supplier name",
          },
          category_id:{
            required:"Please Select the category name",
          },
          name:{
            required:"Please enter product name",
          },
          unit_id:{
            required:"Please Select the unit name",
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