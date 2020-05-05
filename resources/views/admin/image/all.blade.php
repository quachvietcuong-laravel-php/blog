@extends('admin.layouts.admin')

@section('content')

<div class="table-agile-info">
  	<div class="panel panel-default">
	    <div class="panel-heading">
	     	Danh sách hình ảnh bài viết
	    </div>
	    <div class="row w3-res-tb">
	  		<div class="col-sm-3">
		        <div class="input-group">
		          	<input type="text" class="input-sm form-control" placeholder="Search">
		          	<span class="input-group-btn">
		            	<button class="btn btn-sm btn-default" type="button">Go!</button>
		          	</span>
		        </div>
	      	</div>
	    </div>
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
		
	    <div class="table-responsive">
	      	<table class="table table-striped b-t b-light">
	        	<thead>
		          	<tr>
		            	<th>ID</th>
		            	<th>Hình ảnh</th>
			            <th>Tên bài viết</th>
			            <th style="width:30px;"></th>
		          	</tr>
	        	</thead>
		        <tbody>
		        	@foreach($image as $img)
			          	<tr>
			          		<td>{{ $img->id }}</td>
			          		<td>
			          			<img width="100px;" src="{{url('uploads/posts/' . $img->name)}}">
			          		</td>
			          		<td>{{ $img->posts->name }}</td>
			          		<td>
			          			<a href="{{url('admin/image/delete/' . $img->id)}}">Xóa</a>
			          			<a href="{{url('admin/image/edit/' . $img->id)}}">Sửa</a>
			          		</td>
			          	</tr>
		          	@endforeach	            
		        </tbody>
	      	</table>
	    </div>

	    <footer class="panel-footer">
	      	<div class="row">
		        <div class="col-sm-5 text-center">
		          	<small class="text-muted inline m-t-sm m-b-sm">Tổng: {{ $image->total() }} hình ảnh</small>
		        </div>
		        <div class="col-sm-7 text-right text-center-xs">                
		          	{{ $image->links() }}
	    		</div>
	      	</div>
    	</footer>
  	</div>
</div>

@endsection