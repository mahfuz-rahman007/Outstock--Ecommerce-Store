<?php

namespace App\Http\Controllers\Admin;

use App\Model\Setting;
use App\Model\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FooterController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default',1)->first();
    }

    public function index(Request $request){

         $lang = Language::where('code', $request->language)->first()->id;

        $footerinfo = Setting::where('language_id', $lang)->first();

        return view('admin.footer.index', compact('footerinfo'));
    }

    public function update(Request $request, $id){


        $request->validate([
            'copyright_text' => 'required|max:250',
            'footer_text' => 'required',
       ]);

       $footerinfo = Setting::where('language_id', $id)->first();

       $footerinfo->copyright_text = $request->copyright_text;
       $footerinfo->footer_text = $request->footer_text;
       $footerinfo->save();


      $notification = array(
            'messege' => 'Footer Info Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.footer.index').'?language='.$this->lang->code)->with('notification', $notification);
    }
}
