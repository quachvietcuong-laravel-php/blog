@extends('admin.layouts.admin')

@section('content')

<div class="table-agile-info">
  	<div class="panel panel-default">
	    <div class="panel-heading">
	     	Danh sách danh mục sản phẩm
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
			            <th>Tên danh mục</th>
			            <th>Tên không dấu</th>
			            <th>Mô tả</th>
			            <th style="width:30px;"></th>
		          	</tr>
	        	</thead>
		        <tbody>
		        	@foreach($category as $ct)
			          	<tr>
			          		<td>{{ $ct->id }}</td>
			          		<td>{{ $ct->name }}</td>
			          		<td>{{ $ct->slug }}</td>
			          		<td>{{ $ct->description }}</td>
			          		<td>
			          			<a href="{{url('admin/category/delete/' . $ct->id)}}">Xóa</a>
			          			<a href="{{url('admin/category/edit/' . $ct->id)}}">Sửa</a>
			          		</td>
			          	</tr>
		          	@endforeach	            
		        </tbody>
	      	</table>
	    </div>

	    <footer class="panel-footer">
	      	<div class="row">
		        <div class="col-sm-5 text-center">
		          	<small class="text-muted inline m-t-sm m-b-sm">Tổng: {{ $category->total() }} danh mục</small>
		        </div>
		        <div class="col-sm-7 text-right text-center-xs">                
		          	{{ $category->links() }}
	    		</div>
	      	</div>
    	</footer>
  	</div>
</div>

@endsection