<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductAdminService;
use App\Http\Services\Product\ProductService;
use App\Http\Services\Slider\SliderService;
use App\Models\Product;
use App\Models\SliderProduct;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $menuService;
    protected $slider;

    protected $product;

    public function __construct(MenuService $menuService, SliderService $sliderService, ProductService $productService){
        $this->menuService=$menuService;
        $this->slider=$sliderService;
        $this->product=$productService;
    }

    public function index(Request $request){
        
        return view('main', [
            'title'=>"Shop ban hang",
            'menus'=>$this->menuService->getParent(),
            'sliders'=>$this->slider->get(),
            'products'=>$this->product->getProduct(),
            'detals'=>$this->product->getProductDetal($request)
        ]);
    }

    public function loadMore(Request $request){
        $page = $request->input('page', 0);
        $result = $this->product->getProduct($page);
        // dd($result);
        if(count($result) != 0){
            $html = view('list', ['products'=>$result])->render();

            return response()->json([
                'html' => $html
            ]);
        }

        return response()->json([
            'html' => ''
        ]);
    }

    // public function detalProduct(Request $request){
    //     $result = $this->product->getProductDetal($request);

    //     // dd($result);
    //     if($result){
    //         return view('detal', [
    //             'titles'=>'123'
    //         ])->render();
    //     }


    // }
}
