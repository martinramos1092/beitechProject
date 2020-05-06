
<!DOCTYPE html>
<html>
<head>
    <title>Simple Login System in Laravel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .box{
            width:600px;
            margin:0 auto;
            border:1px solid #ccc;
        }
    </style>
</head>
<body>
<br />
<div class="container box" style="width: 80%">
    <h3 align="center">Beitech</h3><br />

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/main/search" method="get">
        <div class="form-inline">
            <select name="Customer" class="form-control input-sm">
                <option value="customer" selected disabled hidden>
                    Customer
                </option>
                @foreach($customers as $customer)
                    <option value="{{$customer->customer_id}}">{{$customer->name    }}</option>
                @endforeach
            </select>
            <label>From:</label>
            <input type="search" name="from" class="form-control mr-1">
            <label>To:</label>
            <input type="search" name="to" class="form-control mr-1">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Creation Date</th>
            <th scope="col">Order Id</th>
            <th scope="col">Total</th>
            <th scope="col">Address</th>
            <th scope="col">Product</th>
        </tr>
        </thead>
        <tbody>
        @isset($orders)
        @foreach($orders as $order)
            <tr>
                <td>{{$order['creation_date']}}</td>
                <td>{{$order['order_id']}}</td>
                <td>{{$order['total']}}</td>
                <td>{{$order['delivery_address']}}</td>
                <td>{{$order['product']}}</td>
            </tr>
            </tr>
        @endforeach
        @endisset
        </tbody>
    </table>
    <br />
<form action="/main/createOrder">
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Create Order</button>
    </div>
</form>
</div>
</body>
</html>
