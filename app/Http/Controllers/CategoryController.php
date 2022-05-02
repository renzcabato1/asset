<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function categories()
    {
        $categories = Category::get();
        return view('categories',
        
        array(
        'subheader' => '',
        'header' => "Category",
        'categories' => $categories
        )
    );
    }

    public function newCategory(Request $request)
    {
        $this->validate($request, [
            'code' => 'unique:categories|required',
            'category_name' => 'required',
            // 'image' => 'required',
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->code = $request->code;
        $category->status = "Active";
        if($request->hasFile('image'))
        {
            $attachment = $request->file('image');
            $original_name = $attachment->getClientOriginalName();
            $name = time().'_'.$attachment->getClientOriginalName();
            $attachment->move(public_path().'/category_images/', $name);
            $file_name = '/category_images/'.$name;
            $category->image_path = $file_name;
        }
        $category->save();
        $request->session()->flash('status','Successfully created');
        return back();
    }

    public function deactivateCategory(Request $request)
    {
        $category = Category::where('id',$request->id)->first();
        $category->status = "Inactive";
        $category->save();

        return $request;
    }
    public function activateCategory(Request $request)
    {
        $brand = Category::where('id',$request->id)->first();
        $brand->status = "Active";
        $brand->save();

        return $request;
        // return $brand;
    }
}
