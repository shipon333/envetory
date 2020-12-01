<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Invoice PDF</title>
	<link rel="stylesheet" href="{{asset('public/Backend')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table width="100%">
					<tbody>
						<tr>
							<td width="31%"><div><strong>Invoice No : </strong> {{$invoice->invoice_no}} <br>
                    		<strong>Date : </strong> {{date('d-m-Y',strtotime($invoice->date))}}</div></td>
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
		<table width="100%">
        @php
          $payment = App\Model\Payment::where('invoice_id',$invoice->id)->first();
        @endphp
        <tbody>
          <tr>
            <td width="25%"><strong>Name : </strong>{{$payment['customer']['name']}}</td>
            <td width="25%"><strong>Mobile : </strong>{{$payment['customer']['mobile']}}</td>
            <td width="50%"><strong>Address : </strong>{{$payment['customer']['address']}}</td>
          </tr>
        </tbody>
      </table>
      <div><strong>Description : </strong><p>{{$invoice->description}}</p></div>
      <br>
      <table border="1" width="100%" class="text-center">
        <thead >
          <tr>
            <td>SL</td>
            <td>Category</td>
            <td>Product Name</td>
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
            <td>{{$key+1}}</td>
            <td>{{$details['category']['name']}}</td>
            <td>{{$details['product']['name']}}</td>
            <td>{{$details->selling_qty}}</td>
            <td>{{$details->unit_price}}</td>
            <td>{{$details->selling_price}}</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="5" class="text-right"><strong>Sub Total</strong></td>
            @php
            $total_sum += $details->selling_price;
            @endphp
            <td>{{$total_sum}}</td>
          </tr>
          <tr>
            <td colspan="5" class="text-right">Descount</td>
            <td>{{$invoice['payment']['discount_amount']}}</td>
          </tr>
          <tr>
            <td colspan="5" class="text-right">Paid Amount</td>
            <td>{{$invoice['payment']['paid_amount']}}</td>
          </tr>
          <tr>
            <td colspan="5" class="text-right">Due Amount</td>
            <td>{{$invoice['payment']['due_amount']}}</td>
          </tr>
          <tr>
            <td colspan="5" class="text-right"><strong>Grand Total</strong></td>
            <td style="background: #ddd">{{$invoice['payment']['total_amount']}}</td>
          </tr>
        </tbody>
      </table>
      <br>
      @php
          	$date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
          @endphp
          <i>Printing Time : {{$date->format('F j, Y, g:i a')}}</i><br><br>
          <div class="row">
			<div class="col-md-12">
				<hr style="margin-bottom: 0px">
				<table border="0" width="100%">
					<tbody>
						<tr>
							<td style="width: 40%">
								<p style="text-align: center;margin-left: 20px">Customer Signature</p>
							</td>
							<td style="width: 20%"></td>
							<td style="width: 40%; text-align:center;">
								<p style="text-align: center;">Seller Signature</p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</body>
</html>