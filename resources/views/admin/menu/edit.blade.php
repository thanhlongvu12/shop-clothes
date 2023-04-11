@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form method="POST" action="">
      <div class="card-body">
        <div class="form-group">
          <label for="name">Tên Danh Mục</label>
          <input type="text" class="form-control" value="{{$menu->name}}" name="name" id="name" placeholder="Name Product">
        </div>

        <div class="form-group">
            <label for="id_product">Mã Danh Mục</label>
            <input type="text" class="form-control" name="id_product" id="id_product" placeholder="ID Product" value="{{$menu->id_product}}">
        </div>

        <div class="form-group">
          <label for="menu">Danh Mục</label>
          <select name="parent_id" class="form-control" id="">
            <option value="0" {{$menu->parent_id == 0 ? 'selected' : ''}}>Danh Mục Cha</option>

            @foreach ($menus as $menuParent)
                <option value="{{$menuParent->id_product}}" 
                        {{$menu->parent_id == $menuParent->id_product ? 'selected' : ''}}>
                    {{$menuParent->name}}
                </option>
            @endforeach

          </select>
        </div>

        <div class="form-group">
            <label>Mô Tả</label>
            <textarea name="description" class="form-control">{{$menu->description}}</textarea>
        </div>

        <div class="form-group">
            <label>Mô Tả Chi Tiết</label>
            <textarea name="content" id="content" class="form-control">{{$menu->content}}</textarea>
        </div>

        <div class="form-group">
            <label for="">Status</label>
            <div class="form-check">
              <input class="form-check-input" value="1" type="radio" id="active" name="active" 
                {{$menu->active == 1 ? 'checked = ""' : ''}}>
              <label for="active" class="form-check-label">Display</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" value="0" type="radio" id="un-active" name="active"
                {{$menu->active == 0 ? 'checked = ""' : ''}}>
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