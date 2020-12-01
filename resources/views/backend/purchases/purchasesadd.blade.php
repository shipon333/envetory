
 @extends('backend.layouts.master')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Purchases</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Purchases</li>
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
                <h3 class="card-title">Add Purchases
                </h3>
                <a href="{{route('purchases.view')}}" class="btn btn-success float-right"><i class="fa fa-plus-circle">Purchases List</i></a>
              </div><!-- /.card-header -->
              <div class="card-body">

                  <div class="row">
                    <div class="form-group col-md-4">
                      <label> Date</label>
                      <input type="text" name="date" id="date" class="form-control datepicker" placeholder="YYYY-MM-DD" readonly>
                    </div>
                    <div class="form-group col-md-4">
                      <label> Purchase No</label>
                      <input type="text" name="purchase_no" id="purchase_no" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="supplier_id">Supplier Name</label>
                      <select name="supplier_id" class="form-control" id="supplier_id">
                          <option value="">Select Supplier</option>
                          @foreach($suppliers as $key=> $supplier)
                          <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label >Categorys Name</label>
                      <select name="category_id" class="form-control" id="category_id">
                          <option value="">Select Category</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="name">Products Name</label>
                      <select name="product_id" class="form-control" id="product_id">
                          <option value="">Select Product</option>
                      </select>
                    </div>
                  <div class="form-group col-md-2">
                    <a class="btn btn-success fa fa-plus-circle addeventmore">Add more</a>
                  </div>
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
<script type="text/javascript">
  $(function(){
    $(document).on('change','#supplier_id',function(){
      var supplier_id = $(this).val();
      $.ajax({
        url:"{{route('get-category')}}",
        type:"GET",
        data:{supplier_id:supplier_id},
        success:function(data){
          var html ='<option value="">Select Category</option>';
          $.each(data,function(key,v){
            html +='<option value"'+v.category_id+'">'+v.category.name+'</option>';

          });
          $('#category_id').html(html);
        }
      });
    });
  });
</script>
<script type="text/javascript">
  $(function(){
    $(document).on('change','#category_id',function(){
      var category_id = $(this).val();
      $.ajax({
        url:"{{route('get-product')}}",
        type:"GET",
        data:{category_id:category_id},
        success:function(data){
          var html2 ='<option value="">Select Category</option>';
          $.each(data,function(key,v){
            html2 +='<option value"'+v.id+'">'+v.name+'</option>';

          });
          $('#product_id').html(html2);
        }
      });
    });
  });
</script>
<!-- <script type="text/javascript">
  $(function(){
    $(document).on('change','#category_id',function(){
      var category_id = $(this).val();
      $.ajax({
        url:"{{route('get-product')}}",
        type:"GET",
        data:{category_id:category_id},
        success:function(data){
          var html ='<option value="">Select Product</option>';
          $.each(data,function(key,v){
            html +='<option value"'+v.id+'">'+v.name+'</option>';

          });
          $('#product_id').html(html);
        }
      });
    });
  });
</script>
 -->  <script>
  $('.datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd'
  });
</script>
   @endsection