<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Daily Invoice Report PDF</title>
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
    <div class="row">
      <div class="col-md-12">
        <hr style="margin-bottom: 0px">
        <table>
          <tbody>
            <tr>
              <td width="25%"></td>
              <td>
                <strong><span style="font-size: 15px">Daily Invoice Report To {{date('d-m-Y',strtotime($start_date))}} From {{date('d-m-Y',strtotime($end_date))}}</span></strong>
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table border="1" width="100%">
                <thead>
                  <tr align="center">
                    <th>SL</th>
                    <th>Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Amount</th>
                  </tr>
                  </thead>
                  <tbody>
                 @php
                  $total_sum = '0';
                 @endphp
                @foreach($alldata as $key => $invoice)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        {{$invoice['payment']['customer']['name']}}
                        ({{$invoice['payment']['customer']['mobile_no']}}({{$invoice['payment']['customer']['address']}})
                    </td>
                    <td>Invoice No #{{$invoice->invoice_no}}</td>
                    <td>{{date('d-m-Y',strtotime($invoice->date))}}</td>
                    <td>{{$invoice->description}}</td>
                    <td>{{$invoice['payment']['total_amount']}}</td>
                    @php
                      $total_sum += $invoice['payment']['total_amount']; 
                    @endphp
                  </tr>
                @endforeach
                <tr>
                  <td colspan="5" style="text-align: right;">Grand Total</td>
                  <td>{{$total_sum}}</td>
                </tr>
                </tbody>
              </table>
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