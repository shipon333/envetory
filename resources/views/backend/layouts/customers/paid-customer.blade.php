@extends('backend.Layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Paid Customer</h1>
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
                   Paid Customer List
                    <a class="float-right btn btn-success btn btn-sm" href="{{route('coustomer.paid.pdf')}}" target="_blank"><i class="fa fa-download"></i>Download PDF</a>
                </h3>
              </div>
              <div class="card-body">
                 <table id="thistabelstyle" class="table table-bordered table-hover">
                    <thead>
                      <tr align="center">
                        <th>SL</th>
                        <th>Customer Name</th>
                        <th>Invoice No</th>
                        <th>Date</th>
                        <th>Paid Amount</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php
                        $total_paid_amount = '0';
                    @endphp
                    @foreach($allData as $key => $payment)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>
                          {{$payment['customer']['name']}}
                          ({{$payment['customer']['mobile']}}-{{$payment['customer']['address']}})
                        </td>
                        <td>Invoice No # {{$payment['invoice']['invoice_no']}}</td>
                        <td>{{date('d-m-Y',strtotime($payment['invoice']['date']))}}</td>
                        <td>{{$payment->paid_amount}} TK</td>
                        <td>
                          <a title="Details" class="btn btn-success" href="{{route('customer.details.invoice',$payment->invoice_id)}}" target="_blank"><i class="fa fa-eye"></i></a>
                        </td>
                      @php
                        $total_paid_amount += $payment->paid_amount;
                      @endphp
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                  <table id="thistabelstyle" class="table table-bordered table-hover">
                    <tbody>
                      <tr>
                        <td colspan="5" colspan="4" style="text-align: right;font-weight: bold">Grand Total</td>
                        <td><strong>{{$total_paid_amount}}</strong> TK</td>
                      </tr>
                    </tbody>
                  </table>
              </div> 
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>
@endsection