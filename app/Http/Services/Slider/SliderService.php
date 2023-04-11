<?php 

namespace App\Http\Services\Slider;

use App\Models\Slider;
use App\Models\SliderProduct;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SliderService{
    public function insert($request){
        try {
            SliderProduct::create([
                'name' => (string) $request->input('name'),
                'url' => (string) $request->input('url'),
                'image_link' => (string) $request->input('file'),
                'sort_by' => (int) $request->input('sort'),
                'active'=> (int) $request->input('active')
            ]);

            Session::flash('success', 'Thêm Thành Công Slider');
        } catch (\Exception $th) {
            Session::flash('error', $th->getMessage());
            Log::info($th->getMessage());
            return false;
        }

        return true;
    }

    public function get(){
        return SliderProduct::orderByDesc('id')->paginate(15);
    }

    public function update($sliderProduct, $request){
        try {
            $sliderProduct->name =(string) $request->input('name');
            $sliderProduct->url = (string) $request->input('url');
            $sliderProduct->image_link = (string) $request->input('file');
            $sliderProduct->sort_by = (int) $request->input('sort');
            $sliderProduct->active = (int) $request->input('active');
            $sliderProduct->save();

            Session::flash('success', 'Update Success');
        } catch (\Throwable $th) {
            Session::flash('error', 'Update False');
            return false;
        }

        return true;
    }

    public function destroy($request){
        $id = $request->input('id');
        $slider = SliderProduct::where('id', $id)->first();

        if($slider){
            $path = str_replace('storage', 'public', $slider->image_link);
            Storage::delete($path);
            $slider->delete();
            return true;
        }

        return false;
    }
}