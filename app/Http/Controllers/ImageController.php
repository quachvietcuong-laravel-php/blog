<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Posts;
use File;

class ImageController extends Controller
{
    //
    public function getAddImage(){
    	$post = Posts::all();
    	return view('admin.image.add', compact('post'));
    }

    public function postAddImage(Request $request){
    	$this->validate($request , 
    		[
                'image'      =>  'required | mimes:jpeg,jpg,png | max:500',
    		] , 
    		[
                'image.required' => 'Bạn chưa nhập hình ảnh',
                'image.mimes'    => 'Hình ảnh không hợp lệ',
                'image.max'      => 'Hình ảnh có độ dài tối đa là 500 kí tự',
    		]
        );
    	$image = new Image;

    	$image->posts_id = $request->posts_id;
    	$file  = $request->file('image');
        $name = $file->getClientOriginalName(); // lấy tên hình
        if (file_exists('uploads/posts/' . $name)) {
            return redirect('admin/image/add')->withErrors('Hình ảnh đã tồn tại');
        }else{
            $file->move('uploads/posts/' , $name);
            $image->name = $name;
        }
        $image->save();
        return redirect('admin/image/add')->with('thongbao','Thêm thành công');
    }

    public function getAllImage(){
    	$image = Image::orderBy('id' , 'DESC')->paginate(10);
    	return view('admin.image.all' , compact('image'));
    }

    public function getDeleteImage($id){
    	$image = Image::where('id' , $id)->first();
    	File::delete("uploads/posts/" . $image->name);
    	$image->delete();
    	return redirect('admin/image/all')->with('thongbao','Xóa thành công');
    }

    public function getEditImage($id){
    	$image = Image::where('id' , $id)->first();
    	$post = Posts::all();
    	return view('admin.image.edit' , compact('image' , 'post'));
    }

    public function postEditImage(Request $request , $id){
    	$this->validate($request , 
    		[
                'image'      =>  'required | mimes:jpeg,jpg,png | max:500',
    		] , 
    		[
                'image.required' => 'Bạn chưa nhập hình ảnh',
                'image.mimes'    => 'Hình ảnh không hợp lệ',
                'image.max'      => 'Hình ảnh có độ dài tối đa là 500 kí tự',
    		]
        );
    	File::delete("uploads/posts/" . $request->image_old);
    	$file  = $request->file('image_new');
        $name = $file->getClientOriginalName(); // lấy tên hình
        $file->move('uploads/posts/' , $name);

        $image = Image::where('id' , $id)->update(['name' => $name , 'posts_id' => $request->posts_id]);

        return redirect('admin/image/edit/' . $id)->with('thongbao','sửa thành công');
    }
}
