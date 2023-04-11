@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form method="POST" action="">
      <div class="card-body">
        <div class="form-group">
          <label for="name">Tên Danh Mục</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="Name Product">
        </div>

        <div class="form-group">
            <label for="id_product">Mã Danh Mục</label>
            <input type="text" class="form-control" name="id_product" id="id_product" placeholder="ID Product">
        </div>

        <div class="form-group">
          <label for="menu">Danh Mục</label>
          <select name="parent_id" class="form-control" id="">
            <option value="0">Danh Mục Cha</option>

            @foreach ($menus as $menu)
                <option value="{{$menu->id_product}}">{{$menu->name}}</option>
            @endforeach

          </select>
        </div>

        <div class="form-group">
            <label>Mô Tả</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Mô Tả Chi Tiết</label>
            <textarea name="content" id="content" class="form-control"></textarea>
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