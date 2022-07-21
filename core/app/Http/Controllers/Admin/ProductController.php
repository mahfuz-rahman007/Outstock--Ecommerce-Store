<?php

namespace App\Http\Controllers\Admin;

use App\Model\Product;
use App\Helpers\Helper;
use App\Model\Language;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\ProductCategory;
use App\Model\ProductSubCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function products(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;

        $data['products'] = Product::where('language_id',$lang)->orderBy('id', 'DESC')->get();

        return view('admin.product.index',$data);

    }

    public function add()
    {
        $pcategories = ProductCategory::where('status', 1)->get();

        $psubcategories = ProductSubCategory::where('status', 1)->get();

        return view('admin.product.add', compact('pcategories','psubcategories'));
    }

    public function store(Request $request)
    {

        $request->validate([

            'language_id' => 'required',
            'title' => 'required|string|unique:products,title',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'description' => 'nullable|string',
            'short_description' => 'required|max:300',
            'current_price' => 'nullable|numeric|min:0',
            'previous_price' => 'nullable|numeric|min:0',
            'stock' => 'required|numeric|min:1',
            'meta_tags' => 'nullable|string|max:191',
            'meta_description' => 'nullable|string|max:191',
            'image' => 'required|mimes:jpeg,jpg,png,webp',
            'status' => 'required|integer|between:0,1',
        ]);


        $product = new Product();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = 'portfolio_'.time().rand().'.'.$extension;
            $file->move('assets/front/img/', $image);
            $product->image = $image;
        }




        $product->stock = $request->stock;
        $product->language_id = $request->language_id;
        $product->title = $request->title;
        $product->slug = Str::slug($request->title, "-");
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->current_price = Helper::storePrice($request->current_price);
        $product->previous_price = Helper::storePrice($request->previous_price);
        $product->status = $request->status;
        $product->meta_tags = $request->meta_tags;
        $product->meta_description = $request->meta_description;
        $product->save();


        // $id = $product->id;

        // if($request->gallery){
        //     foreach($request->gallery as $gallery){
        //     $file = $gallery;
        //     $extension = $file->getClientOriginalExtension();
        //     $gimage = 'portfolio_'.time().rand().'.'.$extension;
        //     $file->move('assets/front/img/', $gimage);
        //         $gallery_image = new ProductImage;
        //         $gallery_image->product_id = $id;
        //         $gallery_image->image = $gimage;
        //         $gallery_image->save();
        //     }
        // }

        // $product->save();

        $notification = array(
            'messege' => 'Product Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $pcategories = ProductCategory::where('status', 1)->get();
        $psubcategories = ProductSubCategory::where('status', 1)->get();

        return view('admin.product.edit', compact('product', 'pcategories', 'psubcategories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'language_id' => 'required',
            'title' => 'required|string|unique:products,title,'.$id,
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'description' => 'nullable|string',
            'short_description' => 'required|max:300',
            'current_price' => 'nullable|numeric|min:0',
            'previous_price' => 'nullable|numeric|min:0',
            'stock' => 'required|numeric|min:1',
            'meta_tags' => 'nullable|string|max:191',
            'meta_description' => 'nullable|string|max:191',
            'image' => 'mimes:jpeg,jpg,png,webp',
            'status' => 'required|integer|between:0,1',
        ]);

        $product = Product::findOrFail($id);

        if($request->hasFile('image')){
            @unlink('assets/front/img/'.$product->image);
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = 'portfolio_'.time().rand().'.'.$extension;
            $file->move('assets/front/img/', $image);
            $product->image = $image;
        }

        $product->stock = $request->stock;
        $product->language_id = $request->language_id;
        $product->title = $request->title;
        $product->slug = Str::slug($request->title, "-");
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->current_price = Helper::storePrice($request->current_price);
        $product->previous_price = Helper::storePrice($request->previous_price);
        $product->status = $request->status;
        $product->meta_tags = $request->meta_tags;
        $product->meta_description = $request->meta_description;
        $product->save();

        $notification = array(
            'messege' => 'Product Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.product').'?language='.$this->lang->code)->with('notification', $notification);


    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        @unlink('assets/front/img/' . $product->image);
        $product->delete();


        $notification = array(
            'messege' => 'Product deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function getcategory(Request $request)
    {
        $table = $request->table;
        $language = $request->language;

        $data = DB::table($table)->where('status', 1)->where('language_id',$language)->get();

        return response()->json($data);
    }

    public function getsubcategory(Request $request)
    {
        $table = $request->table;

        $category = $request->category;

        $data = DB::table($table)->where('status',1)->where('category_id', $category)->get();


        return response()->json($data);
    }

    public function makeFeature(Request $request)
    {

        $product = Product::find($request->product_id);
        $product->is_featured = $request->is_featured;
        $product->save();

        $notification = array(
            'messege' => 'Data Updated successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }
}
