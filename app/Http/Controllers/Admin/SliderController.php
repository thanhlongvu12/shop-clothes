<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Models\SliderProduct;
use Illuminate\Http\JsonResponse;

class SliderController extends Controller
{
    protected $slider;

    public function __construct(SliderService $sliderService){
        $this->slider = $sliderService;
    }
    public function create(){
        return view('admin.slider.add', [
            'title'=> 'Thêm Slider Mới'
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'file'=>'required',
            'url'=>'required'
        ]);

        $this->slider->insert($request);

        return redirect()->back();
    }

    public function index(){
        return view('admin.slider.list', [
            'title'=>'Danh  Sách Slider',
            'Sliders'=>$this->slider->get()
        ]);
    }

    public function edit(SliderProduct $sliderProduct){
        return view('admin.slider.edit', [
            'title'=>'Cập Nhật Slider ' . $sliderProduct->name,
            'sliderEdit'=>$sliderProduct
        ]);
    }

    public function update(Request $request, SliderProduct $sliderProduct){
        $request->validate([
            'name'=>'required',
            'url'=>'required'
        ]);

        $result = $this->slider->update($sliderProduct, $request);
        if($result){
            return redirect('admin/slider/list');
        }

        return redirect()->back();

    }

    public function destroy(Request $request): JsonResponse{
        $result = $this->slider->destroy($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message'=>'Xóa Thành Công'
            ]);
        }
        return response()->json([
            'error'=>true,
            'message'=>'Xóa Thất Bại'
        ]);
    }
}
