@extends('admin.layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa hình ảnh bài viết
            </header>
            
            <div class="panel-body">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{ $err }} <br>
                        @endforeach
                    </div>
                @endif

            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{ session('thongbao') }}
                </div>
            @endif
                <div class="position-center">
                    <form action="{{URL::to('admin/image/edit/' . $image->id)}}" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                                <label for="exampleInputPassword1">Chọn bài viết</label>
                                <select name="posts_id" class="form-control input-sm m-bot15">
                                    @foreach($post as $pt)
                                        <option 
                                            @if($image->posts_id == $pt->id)
                                                checked=""
                                            @endif
                                        value="{{ $pt->id }}">{{ $pt->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <img width="100px;" src="{{ url('uploads/posts/' . $image->name) }}">
                        <input type="hidden" name="image_old" value="{{ $image->name }}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chọn hình ảnh</label>
                            <input type="file" class="form-control" name="image_new" >
                        </div>
                        <button type="submit" name="add_image" class="btn btn-info">Sửa hình ảnh</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection