<?php 

namespace App\Helpers;

class Helper{
    public static function menu($menus, $parent_id = 0, $char = ''){
            $html = '';
            foreach($menus as $key => $menu){
                if($menu->parent_id == $parent_id){
                    $html .= '
                        <tr>
                            <td>'. $menu->id_product .'</td>
                            <td>'. $char . $menu->name .'</td>
                            <td>'. self::active($menu->active) .'</td>
                            <td>'. $menu->updated_at .'</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="/admin/menus/edit/'. $menu->id .'">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" onclick="removeRow('. $menu->id_product .', \'/admin/menus/destroy\')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    ';

                    unset($menus[$key]);

                    $html .= self::menu($menus, $menu->id_product, $char .'--- ');
                }
            }
            return $html;
    }

    public static function listProduct($products){
        $html = '';
        foreach($products as $product){
            $html .= '
                        <tr>
                            <td>'. $product->product_id .'</td>
                            <td>'. $product->name .'</td>
                            <td>'. $product->price .'</td>
                            <td>'. $product->price_sale .'</td>
                            <td>'. $product->menu_id .'</td>
                            <td><a href="'. $product->image .'" target="_blank"><img src="'. $product->image .'" width="100px"></a></td>
                            <td>'. $product->updated_at .'</td>
                            <td>'. self::active($product->active) .'</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="/admin/product/edit/'. $product->id .'">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" onclick="removeRow('. $product->id .', \'/admin/product/destroy\')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    ';
        }
        return $html;
    }

    public static function active($active):string{
        return $active == 0 ? '<span class="btn btn-danger btn-xs">No</span>' : '<span class="btn btn-success btn-xs">Yes</span>';
    }
}