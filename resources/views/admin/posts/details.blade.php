@extends('admin.layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Chi tiết bài viết
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
            </div>
            <h2>Tên bài viết: {{ $posts->name }} - {{ count($like) }} lượt thích</h2>
            <div class="table-responsive" style="margin-bottom: 20px;">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Tên danh mục</th>
                            <th>Người đăng</th>
                            <th>Tiêu đề</th>
                            <th>Nội dung</th>
                            <th>Ngày đăng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $posts->category->name }}</td>
                            <td>{{ $posts->user->name }}</td>
                            <td>{{ $posts->title }}</td>
                            <td>{{ $posts->content }}</td>
                            <td>{{ date('d-m-Y' , strtotime($posts->created_at)) }}</td>
                        </tr>         
                    </tbody>
                </table>
            </div>

            <h2>Hình ảnh của bài viết - {{ count($image) }} Hình</h2>
            <div class="table-responsive" style="margin-bottom: 20px;">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Hình ảnh</th>
                            <th>Ngày đăng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($image as $img)
                        <tr>
                            <td>{{ $img->id }}</td>
                            <td>
                                <img width="100px;" src="{{ url('uploads/posts/' . $img->name) }}"></td>
                            <td>{{ date('d-m-Y' , strtotime($img->created_at)) }}</td>
                        </tr>
                        @endforeach         
                    </tbody>
                </table>
            </div>

            <h2>Bình luận của bài viết - {{ $comment->total() }} bình luận</h2>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên người dùng</th>
                            <th>Ngày đăng</th>
                            <th>Nội dung bình luận</th>
                            <th>Ẩn/Hiện bình luận</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comment as $cmt)
                        <tr>
                            <td>{{ $cmt->id }}</td>
                            <td>{{ $cmt->customers->name }}</td>
                            <td>{{ date('d-m-Y' , strtotime($cmt->created_at)) }}</td>
                            <td>
                                @if($cmt->status == 1)
                                    {{ $cmt->content }}
                                @else
                                    Đã ẩn bình luận
                                @endif
                            </td>
                            <td>
                                @if($cmt->status == 1)
                                    <a href="{{ url('admin/posts/details/hide/' . $cmt->id . '/' . $posts->id) }}">Ẩn</a>
                                @else
                                    <a href="{{ url('admin/posts/details/show/' . $cmt->id . '/' . $posts->id) }}">Hiện</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach         
                    </tbody>
                </table>
                <div style="text-align: center;">{{ $comment->links() }}</div>
            </div>
        </section>
    </div>
</div>

@endsection