@extends('backend.Layouts.master')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Mange Incoice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Incoice</li>
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
          <section class="col-md-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3>Dely Invoice Report
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                    <form action="{{route('dely-report-pdf')}}" method="GET" id="valideform" target="_blank">
                      <div class="row">
                          <div class="form-group col-md-3">
                            <label>Start Date</label>
                            <input type="text" name="start_date" id="start_date" class="form-control form-control-sm datepicker form-control-sm" placeholder="YYYY-MM-DD">
                          </div>
                          <div class="form-group col-md-3">
                            <label>End Date</label>
                            <input type="text" name="end_date" id="end_date" class="form-control form-control-sm datepicker2 form-control-sm" placeholder="YYYY-MM-DD">
                          </div>
                          <div class="form-group col-md-1" style="padding-top: 30px;">
                            <button type="submit" class="btn btn-primary" >Search</button>
                          </div>
                      </div>
                    </form>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<script>
  $('.datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd'
  });
</script>
<script>
  $('.datepicker2').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd'
  });
</script>
<script type="text/javascript">
     $(document).ready(function(){
       $('#valideform').validate({
        rules: {
            start_date: {
                required: true
            },
            end_date: {
                required: true,
            },
        },
        messages:{
          start_date:{
            required:"Please Select the start date",
          },
          end_date:{
            required:"Please Select the end date",
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