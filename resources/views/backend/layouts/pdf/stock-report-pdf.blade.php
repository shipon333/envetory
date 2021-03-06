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
    <hr>
    <div class="row">
      <div class="col-md-12">
        <table border="1" width="100%" style="text-align: center;">
              <thead>
                  <tr>
                      <th>Sl</th>
                      <th>Supplier Name</th>
                      <th>Category Name</th>
                      <th>Product Name</th>
                      <th>Stock</th>
                      <th>Unit Name</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($products as $key=> $product)
                  <tr class="{{$product->id}}">
                      <td>{{$key+1}}</td>
                      <td>{{$product['supplier']['name']}}</td>
                      <td>{{$product['category']['name']}}</td>
                      <td>{{$product->name}}</td>
                      <td>{{$product->quantity}}</td>
                      <td>{{$product['unit']['name']}}</td>
                  </tr>
                  @endforeach
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