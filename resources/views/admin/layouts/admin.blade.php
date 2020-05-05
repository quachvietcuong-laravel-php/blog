@include('admin.layouts.header')

<!--header end-->
<!--sidebar start-->
@include('admin.layouts.aside')
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		@yield('content')

	
</section>
@include('admin.layouts.footer')