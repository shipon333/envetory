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
                            <h3 class="card-title">
                                <strong>Edit Invoice (Invoice No #{{$payment['invoice']['invoice_no']}})</strong>
                            </h3>
                            <a href="{{route('customers.report.view')}}" class="btn btn-success float-right"><i class="fa fa-plus-circle">Customers Cradit</i></a>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <table width="100%">
                                <tbody>
                                  <tr>
                                    <td><strong>Customer Info</strong></td>
                                  </tr>
                                  <tr>
                                    <td width="30%"><strong>Name : </strong>{{$payment['customer']['name']}}</td>
                                    <td width="30%"><strong>Mobile No : </strong>{{$payment['customer']['mobile']}}</td>
                                    <td width="40%"><strong>Address : </strong>{{$payment['customer']['address']}}</td>
                                  </tr>
                                </tbody>
                            </table>
                             <form method="post" action="{{route('customers.update.invoice',$payment->invoice_id)}}" id="myForm">
                                @csrf
                                <table border="1" width="100%" style="margin-bottom: 10px">
                                  <thead>
                                    <tr class="text-center">
                                      <th>SL.</th>
                                      <th>Category</th>
                                      <th>Product Name</th>
                                      <th>Quantity</th>
                                      <th>Unit Price</th>
                                      <th>Total Price</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @php
                                    $total_sum =0;
                                    $invoice_detalis = App\Model\InvoiceDetail::where('invoice_id',$payment->invoice_id)->get();
                                  @endphp
                                  @foreach($invoice_detalis as $key => $details)
                                    <tr class="text-center">
                                      <td>{{$key+1}}</td>
                                      <td>{{$details['category']['name']}}</td>
                                      <td>{{$details['product']['name']}}</td>
                                      <td>{{$details->selling_qty}}</td>
                                      <td>{{$details->unit_price}}</td>
                                      <td>{{$details->selling_price}}</td>
                                    </tr>
                                  @php
                                    $total_sum += $details->selling_price;
                                  @endphp
                                  @endforeach
                                  <tr class="text-center">
                                    <td colspan="5"  class="text-right"><strong>Sub Total</strong></td>
                                    <td><strong>{{$total_sum}}</strong></td>
                                  </tr>
                                  <tr class="text-center">
                                    <td colspan="5"  class="text-right">Discount Amount</td>
                                    <td>{{$payment->discount_amount}}</td>
                                  </tr>
                                  <tr class="text-center">
                                    <td colspan="5"  class="text-right">Paid Amount</td>
                                    <td>{{$payment->paid_amount}}</td>
                                  </tr>
                                  <tr class="text-center">
                                    <td colspan="5"  class="text-right">Due Amount</td>
                                    <input type="hidden" name="new_paid_amount" value="{{$payment->due_amount}}">
                                    <td>{{$payment->due_amount}}</td>
                                  </tr>
                                  <tr class="text-center">
                                    <td colspan="5"  class="text-right"><strong>Grand Total</strong></td>
                                    <td><strong>{{$payment->total_amount}}</strong></td>
                                  </tr>
                                  </tbody>
                                </table>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                      <label>Paid Status</label>
                                      <select name="paid_status" id="paid_status" class="form-control form-control-sm">
                                        <option value="">Select Status</option>
                                        <option value="full_paid">Full Paid</option>
                                        <option value="partial_paid">Partial Paid</option>
                                      </select>
                                      <input type="text" name="paid_amount" class="form-control form-control-sm paid_amount" placeholder="Enter Paid Amount" style="display: none;">
                                    </div>
                                      <div class="form-group col-md-3">
                                        <label>Date</label>
                                        <input type="text" name="date" id="date" class="form-control form-control-sm datepicker" placeholder="YYYY-MM-DD" readonly>
                                      </div>
                                      <div class="form-group col-md-3" style="padding-top: 32px;">
                                          <button type="submit" class="btn btn-success btn-sm">Invoice Update</button>
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
    <script>
        $(document).on('change','#paid_status',function(){
        // alert('ok');
            var paid_status = $(this).val();
            if(paid_status == 'partial_paid') {
              $('.paid_amount').show();
            }else{
              $('.paid_amount').hide();
            }
          });
      </script>
      <script type="text/javascript">
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format :'yyyy-mm-dd'
          });
    </script>
    <script type="text/javascript">
          $(document).ready(function () {
              $('#myForm').validate({
                errorClass:'text-danger',
                validClass:'text-success',
                rules: {
                  paid_status: {
                    required: true,
                  },
                  date: {
                    required: true,
                  }
                },

                messages: {

                },
              });
            });
      </script>
   @endsection