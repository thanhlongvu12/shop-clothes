<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MenuService{

    public function getParent(){
        return Menu::where('parent_id', 0)->get();
    }

    public function getAll(){
        return Menu::orderbyDesc('parent_id')->paginate(20);
    }

    public function create($request){
        try {
            Menu::create([
                'id_product'=> (string) $request->input('id_product'),
                'name' => (string) $request->input('name'),
                'parent_id' => (string) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
                'slug' => Str::slug($request->input('name'), '-')
            ]);

            Session::flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return false;
        }
        return true;
    }

    public function update($request, $menu):bool{
        // $menu->fill($request->input());
        // $menu->save();

        $menu->id_product = (string) $request->input('id_product');
        $menu->name = (string) $request->input('name');
        if($request->input('parent_id') != $menu->id_product){
            $menu->parent_id = (string) $request->input('parent_id');
        }
        $menu->description = (string) $request->input('description');
        $menu->content = (string) $request->input('content');
        $menu->active = (string) $request->input('active');
        $menu->save();

        Session::flash('success', 'Cập Nhật Thành Công Danh Mục');
        return true;
    }

    public function destroy($request){
        $idProduct = (int) $request->input('id_product');
        $menu = Menu::where('id_product', $idProduct)->first();
        
        if($menu){
            return Menu::where('id_product', $idProduct)->delete();
        }

        return false;
    }
}