<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Str;
use App\Posts;
use App\Category;
use App\Comments;
use App\Like;
use App\Customers; 
use App\Image; 

class PostsController extends Controller
{
    //
    public function getAddPost(){
    	$category = Category::all();
    	return view('admin.posts.add' , compact('category'));
    }

    public function postAddPost(Request $request){
    	$this->validate($request , 
    		[
    			'name'  =>   'required | min:3 | max:50',
    			'title'  =>   'required | min:3 | max:50',
    			'content'  =>   'required | min:3 | max:300',
    		] , 
    		[
    			'name.required'	=>	'Bạn chưa nhập tên bài viết',
    			'name.min'			=>	'Tên bài viết phải có ít 3 kí tự',
    			'name.max'			=>	'Tên bài viết có độ dài tối đa là 50 kí tự',

    			'title.required'	=>	'Bạn chưa nhập tên tiêu đề',
    			'title.min'			=>	'Tiêu đề viết phải có ít 3 kí tự',
    			'title.max'			=>	'Tiêu đề viết có độ dài tối đa là 50 kí tự',


    			'content.required'	=>	'Bạn chưa nhập nội dung',
    			'content.min'			=>	'nội dung phải có ít 3 kí tự',
    			'content.max'			=>	'nội dung có độ dài tối đa là 300 kí tự',
    		]
    	);
    	$posts = new Posts;
 	
    	$checkUnique = Posts::where('slug' , Str::slug($request->name , '-'))->first();
    	if ($checkUnique) {
    		return redirect('admin/posts/add')->withErrors('Tên bài viết đã tồn tại');
    	}else{
    		$posts->category_id = $request->category_id;
    		$posts->users_id = Auth::user()->id;
    		$posts->name = $request->name;
    		$posts->title = $request->title;
    		$posts->slug = Str::slug($request->name , '-');
    		$posts->content = $request->content;
    		
    		$posts->save();
    		return redirect('admin/posts/add')->with('thongbao' , 'Thêm thành công');
    	}
    }

    public function getAllPost(){

        $posts = Posts::orderBy('id' , 'DESC')->paginate(5);
        return view('admin.posts.all' , compact('posts'));
    }

    public function getDeletePost($id){
        $posts = Posts::where('id' , $id)->first();
        $posts->delete();
        return redirect('admin/posts/all')->with('thongbao' , 'Xóa thành công');
    }

    public function getEditPost($id){
    	$category = Category::all();
        $posts = Posts::where('id' , $id)->first();
        return view('admin.posts.edit' , compact('posts' , 'category'));
    }

    public function postEditPost(Request $request,$id){
        $this->validate($request , 
    		[
    			'name'  =>   'required | min:3 | max:50',
    			'title'  =>   'required | min:3 | max:50',
    			'content'  =>   'required | min:3 | max:300',
    		] , 
    		[
    			'name.required'	=>	'Bạn chưa nhập tên bài viết',
    			'name.min'			=>	'Tên bài viết phải có ít 3 kí tự',
    			'name.max'			=>	'Tên bài viết có độ dài tối đa là 50 kí tự',

    			'title.required'	=>	'Bạn chưa nhập tên tiêu đề',
    			'title.min'			=>	'Tiêu đề viết phải có ít 3 kí tự',
    			'title.max'			=>	'Tiêu đề viết có độ dài tối đa là 50 kí tự',


    			'content.required'	=>	'Bạn chưa nhập nội dung',
    			'content.min'			=>	'nội dung phải có ít 3 kí tự',
    			'content.max'			=>	'nội dung có độ dài tối đa là 300 kí tự',
    		]
    	);
        $category = Posts::where('id' , $id)->update([
            'name' => $request->name ,
            'slug' => Str::slug($request->name , '-'),
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'users_id' => Auth::user()->id,
        ]);
        return redirect('admin/posts/edit/' . $id)->with('thongbao' , 'Sửa thành công');
    }

    public function getAllPostDetails($id){
        $posts = Posts::where('id' , $id)->first();
        $comment = Comments::where('posts_id' , $posts->id)->paginate(5);
        $like    = Like::where('posts_id' , $posts->id)->where('status' , 1)->get();
        $image   = Image::where('posts_id' , $posts->id)->get();
        return view('admin.posts.details' , compact('posts' , 'comment' , 'like' , 'image'));
    }

    public function getHideCommentPosts($id , $posts_id){
        $comment = Comments::where('id' , $id)->update(['status' => 0]);
        return redirect('admin/posts/details/' . $posts_id)->with('thongbao' , 'Ẩn bình luận thành công');
    }

    public function getShowCommentPosts($id , $posts_id){
        $comment = Comments::where('id' , $id)->update(['status' => 1]);
        return redirect('admin/posts/details/' . $posts_id)->with('thongbao' , 'Hiện bình luận thành công');
    }
}
