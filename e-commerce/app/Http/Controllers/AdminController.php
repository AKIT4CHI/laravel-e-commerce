<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\logs;
use App\Models\User;
use App\Models\Order;
use App\Models\images;
use App\Models\Product;
use App\Models\revenue;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    
    public function view_category(){
        $data=category::all();
        $usertype=Auth::user()->usertype;
        return view('admin.category',compact('data','usertype'));
    }
    public function add_category(Request $request){
        $userid=Auth::user()->usertype;
        $data = new category;
        $log = new logs;
        $data->category_title=$request->category_name;
        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('category',$imagename);
        $data->category_image=$imagename;
        $data->save();
        if($userid==2)
        {
            $log = new logs;
            $log->User_id = $userid;
            $log->action = "Added Category ".$request->category_name;
            $log->save();
        }
        
        return redirect()->back()->with('message','Category Added Successfully');
    }

    

    public function delete_category($id)
    {
        $userid=Auth::user()->usertype;
        $data=category::find($id);
        if($userid==2)
        {
            $log = new logs;
            $log->User_id = $userid;
            $log->action = "Deleted Category ".$data->category_title;
            $log->save();
        }
        $data->delete();
        
        return redirect()->back();
    }

    public function view_product(){
        $category =category::all();
        $product = product::all();
        $usertype=Auth::user()->usertype;
        return view('admin.product',compact('category','usertype'),compact('product'));
        
    }



    public function add_product(Request $request){
        $product = new product;
        
        $product->title=$request->product_name;
        $product->price=$request->product_price;
        $product->discount=$request->discount;
        $product->description=$request->product_description;
        $product->category_id=$request->category;


        






        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $product->image=$imagename;
        $product->save();
        $productId = $product->id;

        
        if($request->hasFile('Multipleimage'))
        {
            foreach($request->file('Multipleimage') as $file)
            {
                $image_name = time().'.'.$file->getClientOriginalName().'.'.$file->getClientOriginalName();

                // Save the image to the "product/details" folder
                $file->move('product/details', $image_name);

                // Create a new Image model and save it to the database
                $multipleImage = new images;
                $multipleImage->Product_id = $productId;
                $multipleImage->image = $image_name;
                $multipleImage->save();

            }
        }
        $userid=Auth::user()->usertype;
        if($userid==2)
        {
            $log = new logs;
            $log->User_id = $userid;
            $log->action = "Added Product ".$request->product_name;
            $log->save();
        }
        return redirect()->back()->with('message','product Added Successfully');
    }

    public function delete_product($id)
    {
        $userid=Auth::user()->usertype;
        $product=product::find($id);
        if($userid==2)
        {
            $log = new logs;
            $log->User_id = $userid;
            $log->action = "Deleted product ".$product->title;
            $log->save();
        }
        
        $product->delete();
        return redirect()->back();
    }

    public function update_product($id)
    {
        $product=product::find($id);
        $category=category::all();
        $usertype=Auth::user()->usertype;
        return view('admin.update_product',compact('product','category','usertype'));
    }

    public function update_product_confirm(Request $request,$id){
        $product =product::find($id);
        $product->title=$request->product_name;
        $product->price=$request->product_price;
        $product->discount=$request->discount;
        $product->description=$request->product_description;
        $product->category_id=$request->category;
        $image=$request->image;
        if($image)
        {
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imagename);
            $product->image=$imagename;
        }
        $userid=Auth::user()->usertype;
        if($userid==2)
        {
            $log = new logs;
            $log->User_id = $userid;
            $log->action = "Updated Product ".$request->product_name;
            $log->save();
        }
        
        $product->save();
        return redirect()->back()->with('message','product updated Successfully');
    }


    public function add_stock($id)
    {
        $product=product::find($id);
        $usertype=Auth::user()->usertype;
        return view('admin.add_stock',compact('product','usertype'));
    }

    public function add_stock_confirm(Request $request,$id)
    {
        $product=product::find($id);
        $revenue=new revenue();
        $product->stock = $request->stock + $product->stock;
        $revenue->Product_id = $product->id;
        $revenue->Money_spent = ($request->stockPrice)/($request->stock);
        $revenue->Money_won = 0;
        $revenue->save();
        $product->save();
        $userid=Auth::user()->usertype;
        if($userid==2)
        {
            $log = new logs;
            $log->User_id = $userid;
            $log->action = "Added Stock of  ".$request->stock."to ".$product->title;
            $log->save();
        }
        
        return redirect()->back()->with('message','Stock Added Successfully');
    }

    public function update_order_status($id)
    {
        $order=Order::find($id);
        $usertype=Auth::user()->usertype;
        return view('admin.update_order_status',compact('order','usertype'));
    }

    public function update_order_confirm(Request $request,$id){
        $order =order::find($id);
        $order->status=$request->status;
        
        $userid=Auth::user()->usertype;
        if($userid==2)
        {
            $log = new logs;
            $log->User_id = $userid;
            $log->action = "Updated Status for order   ".$order->id."to ".$request->status;
            $log->save();
        }
        $order->save();
        return redirect()->back()->with('message','Order Status updated Successfully');
    }

    public function view_user(){
        $user = User::Where('usertype','!=',1)->get();
        $usertype=Auth::user()->usertype;
        $logs = DB::SELECT("SELECT logs.action,logs.created_at,users.name FROM logs INNER JOIN users on users.id = logs.User_id order by created_at desc");
        return view('admin.user',compact('user','usertype','logs'));
        
    }

    public function delete_user($id)
    {
        $user=user::find($id);
        $user->delete();
        return redirect()->back()->with('message','User Deleted Successfully');
    }

    public function update_user($id)
    {
        $user=user::find($id);
        $usertype=Auth::user()->usertype;
        return view('admin.update_user',compact('user','usertype'));
    }

    public function update_user_confirm(Request $request,$id){
        $user =user::find($id);
        $user->usertype=$request->role;
        
        
        $user->save();
        return redirect()->back()->with('message','User  updated Successfully');
    }

    public function order_info($id)
    {
        $order = DB::table('order_infos')
        ->select('products.title', 'order_infos.quantity', 'order_infos.price')
        ->join('products', 'products.id', '=', 'order_infos.Product_id')
        ->where('order_infos.Order_id', '=', $id)
        ->get();
        $usertype=Auth::user()->usertype;
        return view('admin.order_info',compact('order','usertype'));

    }


    
}
