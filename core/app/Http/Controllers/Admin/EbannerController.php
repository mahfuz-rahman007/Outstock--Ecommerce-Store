<?php

namespace App\Http\Controllers\Admin;

use App\Model\Ebanner;
use App\Model\Language;
use Illuminate\Http\Request;
use App\Model\ProductCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EbannerController extends Controller
{

    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function ebanner(Request $request)
    {

        $lang = Language::where('code', $request->language)->first()->id;

        $ebanners = Ebanner::where('language_id', $lang)->orderBy('id', 'DESC')->get();

        return view('admin.ebanner.index', compact('ebanners'));
    }

    // Add ebanner Category
    public function add()
    {
        return view('admin.ebanner.add');
    }

    // Store ebannerCategory
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:250',
            'language_id' => 'required',
            'pcategory_id' => 'required',
            'button_text' => 'required|max:250',
            'image' => 'required|mimes:jpeg,jpg,png',
            'price' => 'nullable|numeric|min:0',
            'status' => 'required|integer|between:0,1',
        ]);

        $ebanner = new Ebanner();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = time().rand().'.'.$extension;
            $file->move('assets/front/img/slider', $image);

            $ebanner->image = $image;
        }

        $ebanner->language_id = $request->language_id;
        $ebanner->pcategory_id = $request->pcategory_id;

        $ebanner->status = $request->status;
        $ebanner->title = $request->title;
        $ebanner->price = $request->price;
        $ebanner->button_text = $request->button_text;
        $ebanner->save();


        $notification = array(
            'messege' => 'Ebanner Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // ebanner Category Delete
    public function delete($id)
    {

        $ebanner = Ebanner::find($id);
        @unlink('assets/front/img/slider/'. $ebanner->image);
        $ebanner->delete();

        $notification = array(
            'messege' => 'E-Banner Deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // ebannerCategory Edit
    public function edit($id)
    {

        $ebanner = Ebanner::find($id);
        return view('admin.ebanner.edit', compact('ebanner'));

    }

    // Update ebanner Category
    public function update(Request $request, $id)
    {

        $id = $request->id;
        $request->validate([
            'title' => 'required|max:250',
            'language_id' => 'required',
            'pcategory_id' => 'required',
            'button_text' => 'required|max:250',
            'image' => 'mimes:jpeg,jpg,png',
            'price' => 'required|numeric|min:0',
            'status' => 'required|integer|between:0,1',
        ]);

        $ebanner = Ebanner::find($id);

        if($request->hasFile('image')){
            @unlink('assets/front/img/slider/'. $ebanner->image);
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = time().rand().'.'.$extension;
            $file->move('assets/front/img/slider/', $image);

            $ebanner->image = $image;
        }

        $ebanner->language_id = $request->language_id;
        $ebanner->pcategory_id = $request->pcategory_id;

        $ebanner->status = $request->status;
        $ebanner->title = $request->title;
        $ebanner->price = $request->price;
        $ebanner->button_text = $request->button_text;
        $ebanner->save();

        $notification = array(
            'messege' => 'E-Banner Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.ebanner').'?language='.$this->lang->code)->with('notification', $notification);
    }


}
