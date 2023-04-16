<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;

class DetalProductController extends Controller
{
    protected $productService;
    protected $menuService;

    public function __construct(ProductService $productService , MenuService $menuService){
        $this->productService = $productService;
        $this->menuService = $menuService;
    }
    public function index($id = '', $slug = ''){
        $product = $this->productService->show($id);
        $moreProduct = $this->productService->more();
        $menu = $this->productService->getMenu($product->menu_id);
        
        return view('product.product', [
            'title'=>$product->name,
            'product'=>$product,
            'menu'=>$menu,
            'more'=>$moreProduct
        ]);
    }
}
