<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;

class CategoryController extends Controller
{
    //
    public function getAddCategory(){
    	return view('admin.category.add');
    }

    public function postAddCategory(Request $request){
    	$this->validate($request , 
    		[
    			'name'  =>   'required | min:3 | max:50',
    			'description'  =>   'required | min:3 | max:300',
    		] , 
    		[
    			'name.required'	=>	'Bạn chưa nhập tên danh mục',
    			'name.min'			=>	'Tên danh mục phải có ít 3 kí tự',
    			'name.max'			=>	'Tên danh mục có độ dài tối đa là 50 kí tự',

    			'description.required'	=>	'Bạn chưa nhập mô tả',
    			'description.min'			=>	'Mô tả phải có ít 3 kí tự',
    			'description.max'			=>	'Mô tả có độ dài tối đa là 300 kí tự',
    		]
    	);
    	$category = new Category;
 	
    	$checkUnique = Category::where('slug' , Str::slug($request->name , '-'))->first();
    	if ($checkUnique) {
    		return redirect('admin/category/add')->withErrors('Tên danh mục đã tồn tại');
    	}else{
    		$category->name = $request->name;
    		$category->slug = Str::slug($request->name , '-');
    		$category->description = $request->description;
    		$category->save();
    		return redirect('admin/category/add')->with('thongbao' , 'Thêm thành công');
    	}
    }

    public function getAllCategory(){
        $category = Category::orderBy('id' , 'DESC')->paginate(5);
        return view('admin.category.all' , compact('category'));
    }

    public function getDeleteCategory($id){
        $category = Category::where('id' , $id)->first();
        $category->delete();
        return redirect('admin/category/all')->with('thongbao' , 'Xóa thành công');
    }

    public function getEditCategory($id){
        $category = Category::where('id' , $id)->first();
        return view('admin.category.edit' , compact('category'));
    }

    public function postEditCategory(Request $request,$id){
        $this->validate($request , 
            [
                'name'  =>   'required | min:3 | max:50',
                'description'  =>   'required | min:3 | max:300',
            ] , 
            [
                'name.required' =>  'Bạn chưa nhập tên danh mục',
                'name.min'          =>  'Tên danh mục phải có ít 3 kí tự',
                'name.max'          =>  'Tên danh mục có độ dài tối đa là 50 kí tự',

                'description.required'  =>  'Bạn chưa nhập mô tả',
                'description.min'           =>  'Mô tả phải có ít 3 kí tự',
                'description.max'           =>  'Mô tả có độ dài tối đa là 300 kí tự',
            ]
        );
        $category = Category::where('id' , $id)->update([
            'name' => $request->name ,
            'slug' => Str::slug($request->name , '-'),
            'description' => $request->description,
        ]);
        return redirect('admin/category/edit/' . $id)->with('thongbao' , 'Sửa thành công');
    }
}
