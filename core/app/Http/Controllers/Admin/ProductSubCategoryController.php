<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\ProductCategory;
use App\Model\ProductSubCategory;
use App\Http\Controllers\Controller;

class ProductSubCategoryController extends Controller
{
    public function productsubcategory($id){
        $pcategory = ProductCategory::find($id);

        $psubcategories = ProductSubCategory::where('category_id', $id)->get();

        return view('admin.product.product-category.subcategory.index', compact('pcategory','psubcategories'));

    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|unique:product_sub_categories,name|max:150',
            'status' => 'required|integer|between:0,1',
        ]);

        $subcategory = new ProductSubCategory();


        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name, "-");
        $subcategory->status = $request->status;
        $subcategory->save();

        $notification = array(
            'messege' => 'Product Sub Category Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function delete($id){

        $subcategory =  ProductSubCategory::findOrFail($id);

        $subcategory->delete();

        $notification = array(
            'messege' => 'Product Sub Category Deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);

    }


    public function edit($id){
        $psubcategory =  ProductSubCategory::find($id);

        $pcategory = ProductCategory::findOrFail($psubcategory->category_id);

        return view('admin.product.product-category.subcategory.edit', compact('psubcategory','pcategory'));

    }

    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required|unique:product_sub_categories,name,'.$id,
            'status' => 'required',
        ]);

        $subcategory =  ProductSubCategory::find($id);


        $subcategory->name = $request->name;
        $subcategory->slug = Str::slug($request->name, "-");
        $subcategory->status = $request->status;
        $subcategory->save();


        $notification = array(
            'messege' => 'Product Sub Category Updated successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

}
