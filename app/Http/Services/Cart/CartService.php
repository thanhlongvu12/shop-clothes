<?php 

namespace App\Http\Services\Cart;

// use Illuminate\Contracts\Session\Session;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class CartService{
    public function create($request){
        $qty = (int)$request->input('num-product');
        $product_id = (int)$request->input('product_id');

        if($qty<=0||$product_id<=0){
            Session::flash('error', 'Sai so luong');
            return false;
        }

        $carts = Session::get('carts');
        if(is_null($carts)){
            Session::put('carts', [
                $product_id => $qty
            ]);

            return true;
        }

        $exists = Arr::exists($carts, $product_id);
        if($exists){
            $carts[$product_id] =$carts[$product_id] + $qty;
            Session::put('carts', $carts);
            return true;
        }  
        $carts[$product_id] = $qty;
        Session::put('carts', $carts);

        return true;
    }

    public function getProduct(){
        $carts = Session::get('carts');
        if(is_null($carts)){
            return [];
        }
       $productID = array_keys($carts);
        
       return Product::select('id', 'name', 'price', 'image')->whereIn('id', $productID)->get();
    }
}