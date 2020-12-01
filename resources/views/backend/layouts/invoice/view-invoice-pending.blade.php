@extends('backend.Layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
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
                   Invoice List
                    <a class="float-right btn btn-success btn btn-sm" href="{{route('invoices.add')}}"><i class="fa fa-plus-circle"></i>Add Invoice</a>
                </h3>
              </div>
              <div class="card-body">
               <table id="thistabelstyle" class="table table-bordered table-hover table-responsive">
                <thead>
                  <tr align="center">
                    <th>SL</th>
                    <th>Customer Name</th>
                    <th style="width: 13%">Invoice No</th>
                    <th style="width: 13%">Invoice Date</th>
                    <th>Description</th>
                    <th style="width: 12%">Amount</th>
                    <th style="width: 12%">Status</th>
                    <th style="width: 12%">Action</th>

                  </tr>
                  </thead>
                  <tbody>
                  @foreach($view_invoice as $key => $invoice)
                  <tr class="{{$invoice->id}}">
                    <td>{{$key++}}</td>
                    <td>{{$invoice['payment']['customer']['name']}}
                      ({{$invoice['payment']['customer']['mobile']}}--{{$invoice['payment']['customer']['address']}})
                    </td>
                    <td>Invoice No # {{$invoice->invoice_no}}</td>
                    <td>{{date('d-m-Y',strtotime($invoice->date))}}</td>
                    <td>{{$invoice->description}}</td>
                    <td>{{$invoice['payment']['total_amount']}}</td>
                    <td>
                      @if($invoice->status=='0')
                      <span style="background-color: #DD5145; padding:5px;">Pending</span>
                      @endif
                    </td>
                    <td>
                      @if($invoice->status=='0')
                        <a title="Approved" class="btn btn-success" href="{{route('approve.invoices',$invoice->id)}}"><i class="fa fa-check-circle"></i></a>
                        <a title="Delete" id="delete" class="btn btn-sm btn-danger" href="{{route('invoices.delete')}}" data-token="{{csrf_token()}}" data-id="{{$invoice->id}}"><i class="fa fa-trash"></i></a>
                      @endif
                    </td>
                  </tr>
                  @endforeach
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