@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form method="POST" action="">
      <div class="card-body">
        <div class="form-group">
          <label for="name">Tên Sản Phẩm</label>
          <input type="text" class="form-control" value="{{$data->name}}" name="name" id="name" placeholder="Name Product">
        </div>

        <div class="form-group">
            <label for="id_product">Mã Sản Phẩm</label>
            <input type="text" class="form-control" name="id_product" id="id_product" placeholder="ID Product" value="{{$data->product_id}}">
        </div>

        <div class="form-group">
          <label for="menu">Thuộc loại</label>
          <select name="menu_id" class="form-control" id="">

            @foreach ($productTypeList as $type)
                <option value="{{$type->id_product}}" {{$data->menu_id == $type->id_product ? 'selected' : ''}}>{{$type->name}}</option>
            @endforeach

          </select>
        </div>

        <div class="form-group">
            <label for="price_product">Giá Sản Phẩm</label>
            <input type="text" class="form-control" value="{{$data->price}}" name="price_product" id="price_product" placeholder="Giá Sản Phẩm">
        </div>

        <div class="form-group">
            <label for="price_product_sales">Giá Sales</label>
            <input type="text" class="form-control" value="{{$data->price}}" name="price_product_sales" id="price_product_sales" placeholder="Giá Sales">
        </div>

        <div class="form-group">
            <label>Mô Tả</label>
            <textarea name="description" class="form-control">{{$data->description}}</textarea>
        </div>

        <div class="form-group">
            <label>Mô Tả Chi Tiết</label>
            <textarea name="content" id="content" class="form-control">{{$data->content}}</textarea>
        </div>

        <div class="form-group">
            <label for="file_image">Ảnh Sản Phẩm</label>
            <label for="file_image">Ảnh Sản Phẩm</label>
            <input type="file" class="form-control" name="file_image" id="upload">
            <div id="image_show">
              <a href="{{$data->image}}"><img src="{{$data->image}}" alt="" width="100px"></a>
            </div>
            <input type="hidden" name="file" id="file" value="{{$data->image}}">
        </div>

        <div class="form-group">
            <label for="">Status</label>
            <div class="form-check">
              <input class="form-check-input" value="1" type="radio" id="active" name="active" {{$data->active == 1 ? 'check=""' : ''}}>
              <label for="active" class="form-check-label">Display</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" value="0" type="radio" id="un-active" name="active" {{$data->active == 0 ? 'check=""' : ''}}>
              <label for="un-active" class="form-check-label">Undisplay</label>
            </div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập Nhật Danh Mục</button>
      </div>
      @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection