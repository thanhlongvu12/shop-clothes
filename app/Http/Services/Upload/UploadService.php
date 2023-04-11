<?php 

namespace app\Http\Services\Upload;

class UploadService{

    public function store($request){
        if($request->hasFile('file')){
            try{
                $name = $request->file('file')->getClientOriginalName(); 
                $pathFull = 'Uploads/'. date("Y/m/d");

                $request->file('file')->storeAs(
                    'public/' . $pathFull, $name
                );

                return '/storage'. '/' . $pathFull . '/' . $name;
            }catch(\Exception $e){
                return false;
            }
        }
    }

}