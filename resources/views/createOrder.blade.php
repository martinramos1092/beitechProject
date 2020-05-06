@extends('default')

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

    <form action="/main/getProducts" method="get">
        <div class="form-group">
            <select name="Customer" class="form-control input-sm" onchange="">
                <option value="customer" selected disabled hidden>
                    Customer
                </option>
                @foreach($customers as $customer)
                    <option value="{{$customer->customer_id}}">{{$customer->name}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Search Products</button>
        </div>
    </form>
    @isset($products)
    <form action="/main/store" method="post">
        @csrf
        <div style="width: 30%" class="form-group">
            @foreach($products as $product)
                <br />
                <input type="text" class="form-control" name="{{$keyDescription++}}desc"  value="{{$product['info']}}" />
                <br />
                <label>Enter quantity</label>
                <br />
                <input type="text" class="form-control" name="{{$key++}}quantity" value="" />
                <input type="hidden" class="form-control" name="{{$keyPrice++}}price" value="{{$product['price']}}" />
            @endforeach
            <button type="submit" class="btn btn-primary">Save Order</button>
            <input type="hidden" class="form-control" name="customerID" value="{{$customerID}}" />
            <input type="hidden" class="form-control" name="numProduct" value="{{$numberOfProducts}}" />
        </div>
    </form>
    @endisset
</div>
</body>
</html>

