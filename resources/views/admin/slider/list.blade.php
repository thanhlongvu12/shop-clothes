@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Link</th>
                <th>Ảnh</th>
                <th>Trạng Thái</th>
                <th>Cập Nhật</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Sliders as $key => $slider )
                <tr>
                    <td>{{$slider->name}}</td>
                    <td>{{$slider->url}}</td>
                    <td><a href="{{$slider->image_link}}" target="_blank"><img src="{{$slider->image_link}}" alt="" width="80px"></a></td>
                    <td>{{$slider->sort_by}}</td>
                    <td>{!! \App\Helpers\Helper::active($slider->active) !!}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/slider/edit/{{$slider->id}}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" onclick="removeRow({{$slider->id}}, '/admin/slider/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection