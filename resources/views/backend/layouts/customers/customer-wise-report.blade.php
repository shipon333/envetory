@extends('backend.Layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Customer Wise Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Customer</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <section class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3>
                   Select Criteria
                    <!-- <a class="float-right btn btn-success btn btn-sm" href="" target="_blank"><i class="fa fa-download"></i>Download PDF</a> -->
                </h3>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <strong>Customer Wise Credit Report</strong>
                        <input type="radio" name="customer_wise_report" value="customer_wise_credit_report" class="search_value">&nbsp;&nbsp;
                        <strong>Customer Wise Paid Report</strong>
                        <input type="radio" name="customer_wise_report" value="customer_wise_paid_report" class="search_value">
                    </div>
                </div>
                <div class="show_credit" style="display: none;">
                  <form method="GET" action="{{route('customers.wise.credit.report')}}" id="customerCreditForm" target="_blank">
                    <div class="form-row">
                        <div class="col-sm-8">
                          <label>Customer Name</label>
                          <select name="customer_id" class="form-control select2">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                              <option value="{{$customer->id}}">{{$customer->name}}({{$customer->mobile}}   {{$customer->address}})</option>
                            @endforeach
                          </select>
                        </div>
                      <div class="col-sm-4" style="padding-top: 29px;">
                        <button type="submit" class="btn btn-success btn-sm">Search</button>
                      </div>
                    </div>
                  </form>
                </div>

                 <div class="show_paid" style="display: none;">
                  <form method="GET" action="{{route('customers.wise.paid.report')}}" id="customerPaidForm" target="_blank">
                    <div class="form-row">
                        <div class="col-sm-8">
                          <label>Customer Name</label>
                          <select name="customer_id" class="form-control select2">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                              <option value="{{$customer->id}}">{{$customer->name}}({{$customer->mobile_no}}   {{$customer->address}})</option>
                            @endforeach
                          </select>
                        </div>
                      <div class="col-sm-2" style="padding-top: 29px;">
                        <button type="submit" class="btn btn-success btn-sm">Search</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>
  <script type="text/javascript">
    $(document).on('change','.search_value',function(){
      var search_value = $(this).val();
      if(search_value == 'customer_wise_credit_report'){
        $('.show_credit').show();
      }else{
        $('.show_credit').hide();
      }
      if(search_value == 'customer_wise_paid_report'){
        $('.show_paid').show();
      }else{
        $('.show_paid').hide();
      }
    });
  </script>
  <script type="text/javascript">
      $(document).ready(function () {
          $('#customerCreditForm').validate({
            ignore:[],
            errorPlacement: function(error, element){
              if(element.attr("name") == "customer_id"){error.insertAfter(element.next()); }
              else{error.insertAfter(element);}
            },
            errorClass:'text-danger',
            validClass:'text-success',
            rules: {
              customer_id: {
                required: true,
              }
            },

            messages: {

            },
          });
        });
  </script>

  <script type="text/javascript">
      $(document).ready(function () {
          $('#customerPaidForm').validate({
            ignore:[],
            errorPlacement: function(error, element){
              if(element.attr("name") == "customer_id"){error.insertAfter(element.next()); }
              else{error.insertAfter(element);}
            },
            errorClass:'text-danger',
            validClass:'text-success',
            rules: {
              customer_id: {
                required: true,
              },
            },

            messages: {

            },
          });
        });
  </script>
@endsection