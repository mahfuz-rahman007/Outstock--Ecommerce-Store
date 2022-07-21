<?php

namespace App\Http\Controllers\Admin;

use App\Model\Language;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\ProductCategory;
use App\Http\Controllers\Controller;
use App\Model\ProductSubCategory;

class ProductCategoryController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function productcategory(Request $request){


        $lang = Language::where('code', $request->language)->first()->id;
        $pcategory  = ProductCategory::where('language_id',$lang)->orderBy('id', 'desc')->get();

        return view('admin.product.product-category.index', compact('pcategory'));
    }


    public function add(){

        return view('admin.product.product-category.add');
    }


    public function store(Request $request){

        $request->validate([
            'name' => 'required|unique:product_categories,name|max:150',
            'language_id' => 'required',
            'status' => 'required|integer|between:0,1',
        ]);

        $category = new ProductCategory();

        $category->language_id = $request->language_id;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name, "-");
        $category->status = $request->status;
        $category->save();

        $notification = array(
            'messege' => 'Product Category Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function delete($id){

        $category = ProductCategory::findOrFail($id);
        // $products = Product::where('category_id', $id)->get();

        // if($products->count() >= 1){
        //     $notification = array(
        //         'messege' => 'First Delete Products Under This Category !',
        //         'alert' => 'warning'
        //     );
        //     return redirect()->back()->with('notification', $notification);
        // }

        $category->delete();

        $notification = array(
            'messege' => 'Product Category Deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);

    }


    public function edit($id){

        $category = ProductCategory::find($id);
        return view('admin.product.product-category.edit', compact('category'));

    }

    public function update(Request $request, $id){

        $id = $request->id;
        $request->validate([
            'name' => 'required|unique:product_categories,name,'.$id,
            'status' => 'required',
        ]);

        $category = ProductCategory::find($id);


        $category->language_id = $request->language_id;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name, "-");
        $category->status = $request->status;
        $category->save();


        $notification = array(
            'messege' => 'Product Category Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.product.category').'?language='.$this->lang->code)->with('notification', $notification);
    }



    public function makePopular(Request $request){

        $category = ProductCategory::find($request->category_id);
        $category->is_popular = $request->is_popular;
        $category->save();

        $notification = array(
            'messege' => 'Data Updated successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }




}
