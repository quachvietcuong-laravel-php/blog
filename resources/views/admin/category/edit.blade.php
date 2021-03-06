@extends('admin.layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa danh mục sản phẩm
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
                    <form action="{{URL::to('admin/category/edit/' . $category->id)}}" method="post" role="form">
                   	@csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" class="form-control" name="name" placeholder="Nhập tên danh mục" value="{{ $category->name }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea  style="resize: none;" rows="5" class="form-control" name="description" placeholder="Mô tả danh mục">{{ $category->description }}</textarea>
                        </div>
                        <button type="submit" name="edit_category" class="btn btn-info">Sửa danh mục</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection