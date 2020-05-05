<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="index.html">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Category</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{url('admin/category/add')}}">Thêm mới</a></li>
						<li><a href="{{url('admin/category/all')}}">Danh sách</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Posts</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{url('admin/posts/add')}}">Thêm mới</a></li>
                        <li><a href="{{url('admin/posts/all')}}">Danh sách</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Image</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{url('admin/image/add')}}">Thêm mới</a></li>
                        <li><a href="{{url('admin/image/all')}}">Danh sách</a></li>
                    </ul>
                </li>
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>