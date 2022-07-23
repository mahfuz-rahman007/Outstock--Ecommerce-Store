<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Model\Language;
use App\Model\Dynamicpage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class DynamicpageController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function dynamic_page(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;

        $dynamicpages = Dynamicpage::where('language_id', $lang)->orderBy('id', 'DESC')->get();

        return view('admin.dynamicpage.index', compact('dynamicpages'));
    }

    public function add()
    {
        return view('admin.dynamicpage.add');
    }

    public function store(Request $request)
    {

        $slug = Str::slug($request->title, '-');

        $request->validate([
            'title' => [
                'required',
                'unique:dynamicpages,title',
                'max:255'],
            'body' => 'required',
            'language_id' => 'required',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'status' => 'required|integer|between:0,1',

        ]);

        $dynamicpage = new Dynamicpage();
        $dynamicpage->language_id = $request->language_id;
        $dynamicpage->title = $request->title;
        $dynamicpage->slug = $slug;
        $dynamicpage->body = $request->body;
        $dynamicpage->status = $request->status;
        $dynamicpage->meta_keywords = $request->meta_keywords;
        $dynamicpage->meta_description = $request->meta_description;
        $dynamicpage->save();

        $notification = array(
            'messege' => 'Daynamic Page Added successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }

    public function edit($id)
    {

        $dynamicpage = Dynamicpage::find($id);
        return view('admin.dynamicpage.edit', compact('dynamicpage'));

    }

    public function update(Request $request, $id)
    {

        $slug = Str::slug($request->title, '-');
        $dynamicpage = Dynamicpage::findOrFail($id);

         $request->validate([
            'title' => [
                'required',
                'max:255',
                'unique:dynamicpages,title,'.$id
            ],
            'body' => 'required',
            'language_id' => 'required',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'status' => 'required|integer|between:0,1',
        ]);

        $dynamicpage->language_id = $request->language_id;
        $dynamicpage->title = $request->title;
        $dynamicpage->slug = $slug;
        $dynamicpage->body = $request->body;
        $dynamicpage->status = $request->status;
        $dynamicpage->meta_keywords = $request->meta_keywords;
        $dynamicpage->meta_description = $request->meta_description;
        $dynamicpage->save();

        $notification = array(
            'messege' => 'Daynamic Page Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.dynamic_page').'?language='.$this->lang->code)->with('notification', $notification);
    }

    public function delete($id)
    {

        $dynamicpage = Dynamicpage::find($id);
        $dynamicpage->delete();

        $notification = array(
            'messege' => 'Daynamic Page Deleted successfully!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }


}
