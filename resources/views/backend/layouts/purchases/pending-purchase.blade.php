@extends('backend.Layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Purchase</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Purchase</li>
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
                   Purchase Pending List
                    <!-- <a class="float-right btn btn-success btn btn-sm" href="{{route('purchases.add')}}"><i class="fa fa-plus-circle"></i>Add Purchase</a> -->
                </h3>
              </div>
              <div class="card-body">
               <table id="thistabelstyle" class="table table-bordered table-hover table-responsive">
                <thead>
                  <tr align="center">
                    <th>SL</th>
                    <th>Purchase No</th>
                    <th>Purchase Date</th>
                    <th>Supplier Name</th>
                    <th>Category Name</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Buying Price</th>
                    <th>Status</th>
                    <th style="width: 12%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($pending_purchases as $key => $purchase)
                  <tr class="{{$purchase->id}}">
                    <td>{{$key+1}}</td>
                    <td>{{$purchase->purchase_no}}</td>
                    <td>{{date('d-m-Y',strtotime($purchase->date))}}</td>
                    <td>{{$purchase['supplier']['name']}}</td>
                    <td>{{$purchase['category']['name']}}</td>
                    <td>{{$purchase['product']['name']}}</td>
                    <td>{{$purchase->description}}</td>
                    <td>
                      {{$purchase->buying_qty}}
                      <span class="float-right" style="color: red">{{$purchase['product']['unit']['name']}}</span>
                    </td>
                    <td>{{$purchase->unit_price}}</td>
                    <td>{{$purchase->buying_price}}</td>
                    <td>
                      @if($purchase->status=='0')
                      <span style="background-color: #DD5145; padding:5px;">Pending</span>
                      @endif
                    </td>
                    <td>
                      @if($purchase->status=='0')
                        <a title="Approved" id="approveBtn" class="btn btn-success" href="{{route('approve.purchase',$purchase->id)}}"><i class="fa fa-check-circle"></i></a>
                      
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