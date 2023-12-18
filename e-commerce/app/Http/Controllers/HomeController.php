<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\revenue;
use App\Models\Category;
use App\Models\OrderInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    

    public function index()
    {
        $product = DB::select("SELECT products.*, categories.category_title as 'category_title' FROM products INNER JOIN categories ON products.category_id = categories.id");
        $category=Category::all();
        
        return view('home.userpage',compact('product','category'));
    }


    public function redirect(){
        $usertype=Auth::user()->usertype;

        if($usertype=='1' || $usertype=='2')
        {
            $chartData =DB::select("SELECT DATE(created_at) AS day, (SUM(Money_won)-SUM(Money_spent)) AS total_revenue FROM revenues GROUP BY day ORDER BY day");
            $chartDataProduct =DB::select("SELECT DATE(revenues.created_at) AS day,
            SUM(Money_won - Money_spent) AS total_revenue,
            products.title
     FROM revenues
     INNER JOIN products ON products.id = revenues.Product_id
     GROUP BY day, products.title
     ORDER BY day");
     $totalRevenueResult = DB::selectOne("SELECT SUM(Money_won - Money_spent) as totalRevenue FROM revenues");
     
            $chartLabels = collect($chartData)->pluck('day');
            $chartValues = collect($chartData)->pluck('total_revenue');
            // $chartLabelsProduct = collect($chartDataProduct)->pluck('day');
            
            $chartValuesProduct = collect($chartDataProduct)->pluck('total_revenue');
            $order = Order::all();
            $sales = Order::Where('status','=','On Delivery')->get();
            $salesToManage = Order::Where('status','=','Ordered')->get();
            $client = User::Where('usertype','=','0')->get();
            $admins = User::Where('usertype','=','2')->get();
            $low_stock = Product::Where('stock','<',6)->get();

            $RevenueProducts1 =DB::select("SELECT date(created_at) as day, sum(Money_won-Money_spent) as 'revenueProduct' FROM revenues where Product_id = 1 GROUP by day");
            $RevenueProduct1 = collect($RevenueProducts1)->pluck('revenueProduct');
            $chartLabelsProduct1 = collect($RevenueProduct1)->pluck('day');

            $RevenueProducts2 =DB::select("SELECT date(created_at) as day, sum(Money_won-Money_spent) as 'revenueProduct' FROM revenues where Product_id = 2 GROUP by day");
            $RevenueProduct2 = collect($RevenueProducts2)->pluck('revenueProduct');

            return view('admin.home',compact('chartLabels','chartValues','chartValuesProduct','totalRevenueResult','sales','salesToManage','client','low_stock','RevenueProduct1','RevenueProduct2','order','usertype','admins'));
        }
        else{
            $id_user=Auth::User()->id;
            $cart=cart::where('User_id','=',$id_user)->get();
            $query = "SELECT SUM(carts.price) as 'Price' from carts where carts.User_id = :id";
            $cartTotal= DB::table('carts')
            ->select(DB::raw('SUM(price) as totalPrice'))
            ->where('User_id', $id_user)
            ->first();
            
            
            $product = DB::select("SELECT products.*, categories.category_title as 'category_title' FROM products INNER JOIN categories ON products.category_id = categories.id");
        $category=Category::all();
        
        return view('home.userpage',compact('product','category','cart','cartTotal'));
        }
    }

    public function product_details($id){
        $product=Product::find($id);
        return view('home.product_details',compact('product'));
    }


    public function productDetails($id){
        $product=Product::find($id);
        $id_user=Auth::User()->id;
            $cart=cart::where('User_id','=',$id_user)->get();
            $query = "SELECT SUM(carts.price) as 'Price' from carts where carts.User_id = :id";
            $cartTotal= DB::table('carts')
            ->select(DB::raw('SUM(price) as totalPrice'))
            ->where('User_id', $id_user)
            ->first();
        $images = DB::select("SELECT * FROM images WHERE Product_id = ?", [$id]);
        return view('home.productDetails',compact('product','cartTotal','cart','images'));
    }


    public function add_cart(Request $request,$id){

        if(Auth::id()){
            $user=Auth::user();
            $product=product::find($id);
            $id_user=Auth::User()->id;
            $cart_check=cart::Where('User_id','=',$id_user)->Where('Product_id','=',$id)->get();
            if(count($cart_check)!=0)
            {
                return redirect()->back()->with('message','product Already Exist in your cart');
            }
            else{
            $cart=new cart;
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->User_id=$user->id;
            $cart->product_title=$product->title;
            if($product->discount!=null){
                $cart->price=$product->discount;
            }
            else{
                $cart->price=$product->price;
            }
            
            $cart->image=$product->image;
            $cart->Product_id=$product->id;
            $cart->quantity=$request->quantity;
            $cart->save();
            return redirect()->back();
            }
            
            
        }

        else{
            return redirect('login');
        }
    }

    public function show_cart(){

        if(Auth::id())
        {
            $id=Auth::User()->id;
            $cart=cart::Where('User_id','=',$id)->get();
            $id_user=Auth::User()->id;
            $cart1=cart::where('User_id','=',$id_user)->get();
            $query = "SELECT SUM(carts.price) as 'Price' from carts where carts.User_id = :id";
            $cartTotal= DB::table('carts')
            ->select(DB::raw('SUM(price) as totalPrice'))
            ->where('User_id', $id_user)
            ->first();
            return view('home.cart',compact('cart','cart1','cartTotal'));
        }
        else{
            return redirect('login');
        }
        
    }

    public function OrderHistory(){

        if(Auth::id())
        {
            $id=Auth::User()->id;
            $cart=cart::Where('User_id','=',$id)->get();
            $id_user=Auth::User()->id;
            $cart1=cart::where('User_id','=',$id_user)->get();
            $query = "SELECT SUM(carts.price) as 'Price' from carts where carts.User_id = :id";
            $cartTotal= DB::table('carts')
            ->select(DB::raw('SUM(price) as totalPrice'))
            ->where('User_id', $id_user)
            ->first();
            $order=order::Where('User_id','=',$id)->orderBy('created_at', 'desc')->get();
            return view('home.OrderHistory',compact('cart','cart1','cartTotal','order'));
        }
        else{
            return redirect('login');
        }
        
    }

    public function order_info($orderId){

        if(Auth::id())
        {
            $id=Auth::User()->id;
            $cart=cart::Where('User_id','=',$id)->get();
            $id_user=Auth::User()->id;
            $cart1=cart::where('User_id','=',$id_user)->get();
            $query = "SELECT SUM(carts.price) as 'Price' from carts where carts.User_id = :id";
            $cartTotal= DB::table('carts')
            ->select(DB::raw('SUM(price) as totalPrice'))
            ->where('User_id', $id_user)
            ->first();
            $order = DB::select("SELECT order_infos.*,products.title,products.image from order_infos INNER JOIN products on products.id = order_infos.Product_id where order_infos.Order_id = $orderId");
        
            return view('home.order_info',compact('cart','cart1','cartTotal','order'));
        }
        else{
            return redirect('login');
        }
        
    }

    public function remove_cart($id){
        $cart=cart::find($id);
        $cart->delete();
        return redirect()->back();  
    }

    public function checkout()
    {
        $id=Auth::User()->id;
        $user=Auth::User();
        $cart=cart::Where('User_id','=',$id)->get();
        $cartTotal= DB::table('carts')
            ->select(DB::raw('SUM(price) as totalPrice'))
            ->where('User_id', $id)
            ->first();

        return view('home.checkout',compact('cart','user','cartTotal'));
    }

    public function add_order(Request $request,$id){
        $user=Auth::user();
        $cart=cart::Where('User_id','=',$id)->get();
        $order=new Order;
        $order->name=$request->name;
        $order->email=$request->email;
        $order->phone=$request->phone;
        $order->address=$request->address;
        $order->User_id=$user->id;
        $order->total = $request->total;
        $order->save();
        $orderId = $order->id;

        foreach($cart as $cart)
        {
            $orderInfo = new OrderInfo;
            $revenue = new revenue;
            $productID = $cart->Product_id;
            $product =product::find($productID);;
            $product->stock = ($product->stock) - ($cart->quantity);
            $product->save();
            $revenue->Product_id = $cart->Product_id;
            $revenue->Money_won = ($cart->price)*($cart->quantity);
            $revenue->Money_spent = 0;
            $revenue->save();
            $orderInfo->Order_id=$orderId;
            $orderInfo->Product_id=$cart->Product_id;
            $orderInfo->quantity=$cart->quantity;
            $orderInfo->price=($cart->price)*($cart->quantity);
            $orderInfo->save();
            $cart_id=$cart->id;
            $cart=cart::find($cart_id);
            $cart->delete();


        }
        
        return redirect()->back();
        
        
    }

}
