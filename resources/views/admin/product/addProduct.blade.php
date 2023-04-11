@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form method="POST" action="">
      <div class="card-body">
        <div class="form-group">
          <label for="name">Tên Sản Phẩm</label>
          <input type="text" class="form-control" value="{{old('name')}}" name="name" id="name" placeholder="Name Product">
        </div>

        <div class="form-group">
            <label for="id_product">Mã Sản Phẩm</label>
            <input type="text" class="form-control" name="id_product" id="id_product" placeholder="ID Product" value="{{old('id_product')}}">
        </div>

        <div class="form-group">
          <label for="menu">Thuộc loại</label>
          <select name="menu_id" class="form-control" id="">

            @foreach ($dataTypeProduct as $type)
                <option value="{{$type->id_product}}">{{$type->name}}</option>
            @endforeach

          </select>
        </div>

        <div class="form-group">
            <label for="price_product">Giá Sản Phẩm</label>
            <input type="text" class="form-control" name="price_product" value="{{old('price_product')}}" id="price_product" placeholder="Giá Sản Phẩm">
        </div>

        <div class="form-group">
            <label for="price_product_sales">Giá Sales</label>
            <input type="text" class="form-control" name="price_product_sales" value="{{old('price_product_sales')}}" id="price_product_sales" placeholder="Giá Sales">
        </div>

        <div class="form-group">
            <label>Mô Tả</label>
            <textarea name="description" class="form-control">{{old('description')}}</textarea>
        </div>

        <div class="form-group">
            <label>Mô Tả Chi Tiết</label>
            <textarea name="content" id="content" class="form-control">{{old('content')}}</textarea>
        </div>

        <div class="form-group">
            <label for="file_image">Ảnh Sản Phẩm</label>
            <input type="file" class="form-control" name="file_image" id="upload">
            <div id="image_show">

            </div>
            <input type="hidden" name="file" id="file">
        </div>

        <div class="form-group">
            <label for="">Status</label>
            <div class="form-check">
              <input class="form-check-input" value="1" type="radio" id="active" name="active" checked="">
              <label for="active" class="form-check-label">Display</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" value="0" type="radio" id="un-active" name="active">
              <label for="un-active" class="form-check-label">Undisplay</label>
            </div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Tạo Danh Mục</button>
      </div>
      @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection