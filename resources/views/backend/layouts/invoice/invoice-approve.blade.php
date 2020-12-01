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
                   <strong>Invoice No : </strong> {{$invoice->invoice_no}} <br>
                    <strong>Date : </strong> {{date('d-m-Y',strtotime($invoice->date))}}
                    <a class="float-right btn btn-success btn btn-sm" href="{{route('invoices.pending.view')}}"><i class="fa fa-list"></i>Pending Invoice</a>
                </h3>
              </div>
              <div class="card-body">
                
                  <table width="100%">
                    @php
                      $payment = App\Model\Payment::where('invoice_id',$invoice->id)->first();
                    @endphp
                    <tbody>
                      <tr>
                        <td width="15%"><strong>Customer Info</strong></td>
                        <td width="25%"><strong>Name : </strong>{{$payment['customer']['name']}}</td>
                        <td width="25%"><strong>Mobile : </strong>{{$payment['customer']['mobile']}}</td>
                        <td width="35%"><strong>Address : </strong>{{$payment['customer']['address']}}</td>
                      </tr>
                      <tr>
                        <td colspan="1"></td>
                        <td><strong>Description : </strong>{{$invoice->description}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <br>
                  <form action="{{route('approve.store',$invoice->id)}}" method="post">
                  @csrf
                  <table border="1" width="100%" class="text-center">
                    <thead >
                      <tr>
                        <td>SL</td>
                        <td>Category</td>
                        <td>Product Name</td>
                        <td style="background: #ddd">Quentity Stock</td>
                        <td>Quentity</td>
                        <td>Unit Price</td>
                        <td>total Price</td>
                      </tr>
                    </thead>
                    @php
                    $total_sum = 0;
                    @endphp
                    <tbody>
                      @foreach($invoice['invoice_details'] as $key => $details)
                      <tr>
                      <input type="hidden" name="category_id[]" value="{{$details->category_id}}">
                        <input type="hidden" name="product_id[]" value="{{$details->product_id}}">
                        <input type="hidden" name="selling_qty[{{$details->id}}]" value="{{$details->selling_qty}}">
                        <td>{{$key+1}}</td>
                        <td>{{$details['category']['name']}}</td>
                        <td>{{$details['product']['name']}}</td>
                        <td>{{$details['product']['quantity']}}</td>
                        <td>{{$details->selling_qty}}</td>
                        <td>{{$details->unit_price}}</td>
                        <td>{{$details->selling_price}}</td>
                      </tr>
                      @endforeach
                      <tr>
                        <td colspan="6" class="text-right"><strong>Sub Total</strong></td>
                        @php
                        $total_sum += $details->selling_price;
                        @endphp
                        <td>{{$total_sum}}</td>
                      </tr>
                      <tr>
                        <td colspan="6" class="text-right">Descount</td>
                        <td>{{$invoice['payment']['discount_amount']}}</td>
                      </tr>
                      <tr>
                        <td colspan="6" class="text-right">Paid Amount</td>
                        <td>{{$invoice['payment']['paid_amount']}}</td>
                      </tr>
                      <tr>
                        <td colspan="6" class="text-right">Due Amount</td>
                        <td>{{$invoice['payment']['due_amount']}}</td>
                      </tr>
                      <tr>
                        <td colspan="6" class="text-right"><strong>Grand Total</strong></td>
                        <td style="background: #ddd">{{$invoice['payment']['total_amount']}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <br>
                  <button type="submit" class="btn btn-success">Submit</button>
                </form>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>
@endsection