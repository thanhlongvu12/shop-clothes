<?php

namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Http\Services\Product\ProductService;

class ProductAdminService{
    public function getProductType(){
        return DB::table('menus')->get();
    }

    public function getProduct(){
        return Product::orderbyDesc('name')->paginate(20);
    }

    protected function isValidPrice($request){
        if($request->input('price_product') != 0 && $request->input('price_product_sales') != 0  && $request->input('price_product_sales') >= $request->input('price_product')){
            Session::flash('error', 'Giá giảm phải bé hơn giá bán');
            return false;
        }

        if( (int)$request->input('price_product') == 0 && $request->input('price_product_sales') == 0){
            Session::flash('error', 'Giá giảm phải bé hơn giá bán');
            return false;
        }

        return true;

    }

    public function create($request){
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice == false){
            return false;
        }

        try {
            Product::create([
                'product_id'=> (string) $request->input('id_product'),
                'name' => (string) $request->input('name'),
                'menu_id' => (string) $request->input('menu_id'),
                'price' => (string) $request->input('price_product'),
                'price_sale' => (string) $request->input('price_product_sales'),
                'image' => (string) $request->input('file'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (int) $request->input('active'),
            ]);

            Session::flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return false;
        }
        return true;
    }

    public function update($product, $request){
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice == false){
            return false;
        }

        try{
            $product->product_id = (string) $request->input('id_product');
            $product->name = (string) $request->input('name');
            $product->menu_id = (string) $request->input('menu_id');
            $product->price = (string) $request->input('price_product');
            $product->price_sale = (string) $request->input('price_product_sales');
            $product->image = (string) $request->input('file');
            $product->description = (string) $request->input('description');
            $product->content = (string) $request->input('content');
            $product->active = (int) $request->input('active');
            $product->save();

            Session::flash('success', 'Cập Nhật Thành Công Danh Mục');
        }catch(\Exception $e){
            Session::flash('error', 'Cập Nhật Thất Bại Danh Mục');
            return false;
        }
        return true;
    }

    public function destroy($request){
        $id_destroy = $request->input('id');
        $check = Product::where('id', $id_destroy);
        if($check){
            return Product::where('id', $id_destroy)->delete();
        }
        return false;
    }
}