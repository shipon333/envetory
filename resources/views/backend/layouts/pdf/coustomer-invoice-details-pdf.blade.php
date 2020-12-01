<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer Cradit Report PDF</title>
  <link rel="stylesheet" href="{{asset('public/Backend')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <table width="100%">
          <tbody>
            <tr>
              <td width="25%"></td>
              <td>
                <span style="font-size: 20px;background: #1781BF;padding: 3px 10px 3px 10px; color: #fff;">SM Fashon House</span> <br>
                  Harunja, Kalai, Joypurhat.
              </td>
              <td width="32%">
                <span>
                  Showroom No : 01771-835208 <br>
                  Owner No : 01777-145222
                </span>
              </td>
            </tr>
          </tbody>  
        </table>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
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
                                <table border="1" width="100%" style="margin-bottom: 10px" class="text-center">
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
                                  <tr>
                                    <td colspan="6" style="text-align: center;"><strong>Paid Summary</strong></td>
                                  </tr>
                                  <tr style="text-align: center;">
                                    <td colspan="3" style="text-align: center;">Date</td>
                                    <td colspan="3" style="text-align: center;">Amount</td>
                                  </tr>
                                  @php
                                    $payment_details = App\Model\PaymentDetail::where('invoice_id',$payment->invoice_id)->get();
                                  @endphp
                                  @foreach($payment_details as $dtl)
                                  <tr style="text-align: center;">
                                    <td colspan="3" style="text-align: center;">{{date('d-m-Y',strtotime($dtl->date))}}</td>
                                    <td colspan="3" style="text-align: center;">{{$dtl->current_paid_amount}}</td>
                                  </tr>
                                  @endforeach
                                  </tbody>
                                </table>
                        </div>
          <br>
          <hr>
          @php
            $date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
          @endphp
          <i>Printing Time : {{$date->format('F j, Y, g:i a')}}</i>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table border="0" width="100%">
          <tbody>
            <tr>
              <td style="width: 40%"></td>
              <td style="width: 20%"></td>
              <td style="width: 40%; text-align:center;">
                <p style="text-align: center; border-bottom: 1px solid #000;">Owner Signature</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>