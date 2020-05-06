<?php

namespace App\Http\Controllers;

use App\Customer;
use App\CustomerProduct;
use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Validator;


class OrderController extends Controller
{
    public function __construct()
    {
    }

    function index()
    {
        $customers = Customer::all();
        return view('main',compact('customers'));
    }

    function search(Request $request)
    {
        $this->validate($request,[
            'from' => 'required',
            'to' => 'required',
            'Customer'=>'required'
        ]);
        $fromDate = $request->get('from');
        $toDate = $request->get('to');
        $customer = $request->get('Customer');
        $customers = Customer::all();
        $ordersArray = Order::where('customer_id',$customer)
                              ->where('creation_date','>',"$fromDate")
                              ->where('creation_date','<',"$toDate")->get()->toArray();

        $orders = array();
        foreach ($ordersArray as $order){
            $orderProducts = OrderDetail::where('order_id',$order['order_id'])->get()->toArray();
            $order['product'] = '';
            foreach ($orderProducts as $orderProduct)
            {
                $order['product'].= $orderProduct['quantity']. "X ". $orderProduct['product_description'] ." ";
            }
            $order['total'] = "$ " . $order['total'];
            $orders[] = $order;
        }
        return view('main',compact('customers','orders'));
    }

    public function createOrder()
    {
        $customers = Customer::all();
        return view('createOrder',compact('customers'));
    }

    public function getProducts(Request $request)
    {
        $customers = Customer::all();
        $customerID = $request->get('Customer');
        $productsID = CustomerProduct::where('customer_id',$request->get('Customer'))->get()->toArray();
        foreach ($productsID as $product)
        {
            $productsInfo = Product::where('product_id',$product['product_id'])->get()->toArray();
            $productsDesc['info'] = $productsInfo[0]['product_description'] ." $ ". $productsInfo[0]['price'];
            $productsDesc['price'] = $productsInfo[0]['price'];
            $products[] = $productsDesc;
        }
        $key =0;
        $numberOfProducts = count($products);
        $keyPrice =0;
        $keyDescription =0;
        return view('createOrder',compact('customers','products','customerID','key','numberOfProducts','keyPrice','keyDescription'));
    }

    public function store(Request $request)
    {
        $sum = 0;
        $price =0;
        $description ='';
        $numOfProducts = $request->get('numProduct');
        for($i =0;$i<$numOfProducts;$i++)
        {
            if($request->get($i.'quantity') != '') {
                $sum += intval($request->get($i . 'quantity'));
                $description .= $request->get($i . 'desc') . " ";
                $price += (intval($request->get($i.'price')) * $request->get($i . 'quantity')) ;
            }
        }
        if($sum<=5){
            $order = new Order();
            $today = date("Y-m-d H:i:s");
            $order->customer_id = $request->get('customerID');
            $order->creation_date = $today;
            $order->total= $price;
            $order->save();
            $customers = Customer::all();
            return view('main',compact('customers'));
        }else{
            return back()->with('error','You can not order more than 5 items');
        }

    }
}
