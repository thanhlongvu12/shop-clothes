@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID Product</th>
                <th>Name</th>
                <th>Price</th>
                <th>Price Seles</th>
                <th>Menu Id</th>
                <th>Image</th>
                <th>Update</th>
                <th>Active</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                {!! \App\Helpers\Helper::listProduct($data) !!}
            </tr>
        </tbody>
    </table>
@endsection