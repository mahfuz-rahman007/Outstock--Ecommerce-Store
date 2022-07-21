<?php

namespace App\Http\Controllers\Admin;

use App\Model\Slider;
use App\Model\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{

    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function slider(Request $request)
    {

        $lang = Language::where('code', $request->language)->first()->id;

        $sliders = Slider::where('language_id', $lang)->orderBy('id', 'DESC')->get();

        return view('admin.home.slider.index', compact('sliders'));
    }

    // Add slider Category
    public function add()
    {
        return view('admin.home.slider.add');
    }

    // Store slider Category
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:250',
            'language_id' => 'required',
            'text' => 'required|max:250',
            'image' => 'required|mimes:jpeg,jpg,png',
            'serial_number' => 'required|numeric',
            'status' => 'required|integer|between:0,1',
        ]);

        $slider = new Slider();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = time().rand().'.'.$extension;
            $file->move('assets/front/img/slider', $image);

            $slider->image = $image;
        }

        $slider->language_id = $request->language_id;
        $slider->status = $request->status;
        $slider->title = $request->title;
        $slider->text = $request->text;
        $slider->serial_number = $request->serial_number;
        $slider->button_text = $request->button_text;
        $slider->save();


        $notification = array(
            'messege' => 'Slider Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // slider Category Delete
    public function delete($id)
    {

        $slider = Slider::find($id);
        @unlink('assets/front/img/slider/'. $slider->image);
        $slider->delete();

        $notification = array(
            'messege' => 'Slider Deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    // slider Category Edit
    public function edit($id)
    {

        $slider = Slider::find($id);
        return view('admin.home.slider.edit', compact('slider'));

    }

    // Update slider Category
    public function update(Request $request, $id)
    {

        $id = $request->id;
        $request->validate([
            'title' => 'required|max:250',
            'language_id' => 'required',
            'text' => 'required|max:250',
            'image' => 'mimes:jpeg,jpg,png',
            'serial_number' => 'required|numeric',
            'status' => 'required|integer|between:0,1',
        ]);

        $slider = Slider::find($id);

        if($request->hasFile('image')){
            @unlink('assets/front/img/slider/'. $slider->image);
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = time().rand().'.'.$extension;
            $file->move('assets/front/img/slider/', $image);

            $slider->image = $image;
        }

        $slider->language_id = $request->language_id;
        $slider->status = $request->status;
        $slider->title = $request->title;
        $slider->text = $request->text;
        $slider->serial_number = $request->serial_number;
        $slider->button_text = $request->button_text;
        $slider->save();

        $notification = array(
            'messege' => 'Slider Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.slider').'?language='.$this->lang->code)->with('notification', $notification);
    }
}
