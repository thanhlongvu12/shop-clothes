<?php 

namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;

class ProductService{
    const LIMIT = 16;
    public function getProduct($page = null){
        return Product::select('id', 'name', 'price', 'image')
            ->orderbyDesc('id')
            ->when($page != null, function($query) use ($page){
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    public function getProductDetal($request){
        $id = $request->input('id');
        $product = Product::where('id', $id);
        if($product){
            return Product::where('id', $id)->get();
        }

        return false;
    }

    public function show($id){
        return Product::where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function getMenu($menu_id){
        return Menu::where('id', $menu_id)->firstOrFail();
    }

    public function more(){
        return Product::select('id', 'name', 'price', 'image')->orderbyDesc('id')->get();
    }
}