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
                            <h3 class="card-title">Customers Cradit List</h3>
                            <a href="{{route('coustomer.cradit.pdf')}}" target="_blank" class="btn btn-success float-right"><i class="fa fa-plus-circle">Customers pdf</i></a>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Customer Name</th>
                                        <th>Invoice No</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $total_due = 0;
                                    @endphp
                                    @foreach($alldata as $key=> $payment)
                                    <tr class="{{$payment->id}}">
                                        <td>{{$key+1}}</td>
                                        <td>{{$payment['customer']['name']}}-{{$payment['customer']['mobile']}}--{{$payment['customer']['address']}}</td>
                                        <td>Invoice NO : {{$payment['invoice']['invoice_no']}}</td>
                                        <td>{{date('d-m-Y',strtotime($payment['invoice']['date']))}}</td>
                                        <td>{{$payment->due_amount}}</td>
                                        <td>
                                            <a href="{{route('customer.edit.invoice',$payment->invoice_id)}}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a title="Details" id="Details" class="btn btn-sm btn-success" href="{{route('customer.details.invoice',$payment->invoice_id)}}"><i class="fa fa-eye"></i></a>
                                        </td>
                                        @php
                                        $total_due +=$payment->due_amount;
                                        @endphp
                                    </tr>

                                    @endforeach
                                    <tr>
                                        <td colspan="4" style="text-align: right;font-weight: bold;">Grand Total</td>
                                        <td>
                                           {{$total_due}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
   @endsection