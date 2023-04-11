<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductAdminService;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends Controller
{
    protected $productAdminService;

    public function __construct(ProductAdminService $productAdminService){
        $this->productAdminService = $productAdminService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.addProduct',[
            'title'=>'Thêm Sản phẩm',
            'dataTypeProduct'=>$this->productAdminService->getProductType()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'file'=>'required'
        ]);
        $this->productAdminService->create($request);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('admin.product.listProduct', [
            'title' => 'Danh Sách Sản Phẩm',
            'data'=> $this->productAdminService->getProduct()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.product.editProduct',[
            'title'=>'Edit Product ' . $product->name,
            'data'=> $product,
            'productTypeList'=> $this->productAdminService->getProductType()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product, Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $result = $this->productAdminService->update($product, $request);
        if($result){
            return redirect('/admin/product/list');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse 
    {
        $result = $this->productAdminService->destroy($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message'=>'Xóa thành công'
            ]);
        }
        return response()->json([
            'error'=>true,
            'message'=>'Xóa Thất Bại'
        ]);
    }
}
