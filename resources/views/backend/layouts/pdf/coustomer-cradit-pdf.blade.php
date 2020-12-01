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
        <table id="example1" border="1" class="table table-bordered table-striped" style="text-align: center; width: 100%;">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Customer Name</th>
                    <th>Invoice No</th>
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                $total_due = 0;
                @endphp
                @foreach($coustomer as $key=> $report)
                <tr class="{{$report->id}}">
                    <td>{{$key+1}}</td>
                    <td>{{$report['customer']['name']}}-{{$report['customer']['mobile']}}--{{$report['customer']['address']}}</td>
                    <td>Invoice NO : {{$report['invoice']['invoice_no']}}</td>
                    <td>{{date('d-m-Y',strtotime($report['invoice']['date']))}}</td>
                    <td>{{$report->due_amount}}</td>
                    @php
                    $total_due +=$report->due_amount;
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