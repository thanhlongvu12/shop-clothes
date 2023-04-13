<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use Illuminate\Http\Request;

class MenuProductController extends Controller
{

    protected $menuService;

    public function __construct(MenuService $menuService){
        $this->menuService = $menuService;
    }
    public function index(Request $request, $id, $slug){
        $menu = $this->menuService->getID($id);
        $products = $this->menuService->getProduct($menu, $request);

        return view('menu',[
            'title'=>$menu->name,
            'products'=>$products,
            'menu'=>$menu
        ]);
    }
}
