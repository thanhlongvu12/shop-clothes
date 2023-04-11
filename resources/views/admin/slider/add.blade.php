@extends('admin.main')


@section('content')
    <form method="POST" action="">
      <div class="card-body">
        <div class="form-group">
          <label for="name">Tên Slider</label>
          <input type="text" class="form-control" value="{{old('name')}}" name="name" id="name">
        </div>

        <div class="form-group">
            <label for="id_product">Đường dẫn</label>
            <input type="text" class="form-control" name="url" id="url" placeholder="ID Product" value="{{old('url')}}">
        </div> 

        <div class="form-group">
            <label for="file_image">Ảnh Sản Phẩm</label>
            <input type="file" class="form-control" name="file_image" id="upload">
            <div id="image_show">

            </div>
            <input type="hidden" name="file" id="file">
        </div>

        <div class="form-group">
            <label for="id_product">Sắp Xếp</label>
            <input type="text" class="form-control" name="sort" id="sort" placeholder="ID Product" value="{{old('sort')}}">
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
        <button type="submit" class="btn btn-primary">Thêm Slider</button>
      </div>
      @csrf
    </form>
@endsection