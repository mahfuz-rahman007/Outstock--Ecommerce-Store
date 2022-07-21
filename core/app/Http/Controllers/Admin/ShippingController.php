<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Model\Language;
use App\Model\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function shipping(Request $request){
        $lang = Language::where('code', $request->language)->first()->id;
        $data['methods'] = Shipping::where('language_id',$lang)->orderBy('id', 'DESC')->get();
        return view('admin.shipping.index', $data);
    }

    //Add Method
    public function add(){
        return view('admin.shipping.add');
    }

    // Store Method
    public function store(Request $request){

        $request->validate([
            'language_id' => 'required',
            'title' => 'required|unique:shippings|max:100',
            'cost' => 'required|min:0',
            'subtitle' => 'required',
        ]);

        $method = new Shipping();
        $method->language_id = $request->language_id;
        $method->title = $request->title;
        $method->subtitle = $request->subtitle;
        $method->cost = Helper::storePrice($request->cost);
        $method->save();


        $notification = array(
            'messege' => 'Shipping Method Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);

    }

    //Method Delete
    public function delete($id){
        $method = Shipping::find($id);
        $method->delete();

        $notification = array(
            'messege' => 'Shipping Method Deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);

    }

    //Method Delete
    public function edit($id){

        $method = Shipping::find($id);
        return view('admin.shipping.edit', compact('method'));

    }

    // Method Update
    public function update(Request $request, $id){

        $request->validate([
            'language_id' => 'required',
            'title' => 'required|max:100|unique:shippings,id,'.$id,
            'subtitle' => 'required|max:100',
            'cost' => 'required|min:0',
        ]);

        $method = Shipping::findOrFail($id);
        $method->language_id = $request->language_id;
        $method->title = $request->title;
        $method->cost = Helper::storePrice($request->cost);
        $method->subtitle = $request->subtitle;
        $method->update();



        $notification = array(
            'messege' => 'Shipping Method Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.shipping').'?language='.$this->lang->code)->with('notification', $notification);

    }
}
