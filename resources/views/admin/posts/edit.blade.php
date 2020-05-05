@extends('admin.layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa bài viết
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
                    <form action="{{URL::to('admin/posts/edit/' . $posts->id)}}" method="post" role="form">
                   	@csrf
                       <div class="form-group">
                                <label for="exampleInputPassword1">Tên thể loại</label>
                                <select name="category_id" class="form-control input-sm m-bot15">
                                    @foreach($category as $ct)
                                        <option
                                        @if($posts->category_id == $ct->id)
                                            selected=""
                                        @endif
                                        value="{{ $ct->id }}">{{ $ct->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên bài viết</label>
                            <input type="text" class="form-control" name="name" value="{{ $posts->name }}" placeholder="Nhập tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tiêu đề</label>
                            <input type="text" class="form-control" name="title" value="{{ $posts->title }}" placeholder="Nhập tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung</label>
                            <textarea  style="resize: none;" rows="5" class="form-control" name="content" placeholder="Mô tả danh mục">{{ $posts->content }}</textarea>
                        </div>
                        <button type="submit" name="edit_post" class="btn btn-info">Sửa bài viết</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection