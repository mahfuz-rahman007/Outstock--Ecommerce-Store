<?php

namespace App\Http\Controllers\Admin;

use App\Model\Setting;
use App\Model\Language;
use App\Model\Sectiontitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::all();

        return view('admin.language.index', compact('languages'));
    }

    public function add()
    {
        return view('admin.language.add-languages');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'direction' => 'required',
            'code' => [
                'required',
                'max:255'
            ],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          $errmsgs = $validator->getMessageBag()->add('error', 'true');
          return response()->json($validator->errors());
        }

        $data = file_get_contents(resource_path('lang/') . 'default.json');
        $json_file = trim(strtolower($request->code)) . '.json';
        $path = resource_path('lang/') . $json_file;

        File::put($path, $data);

        $in['name'] = $request->name;
        $in['code'] = $request->code;
        $in['direction'] = $request->direction;
        if (Language::where('is_default', 1)->count() > 0) {
          $in['is_default'] = 0;
        } else {
          $in['is_default'] = 1;
        }
        $lang_id = Language::create($in)->id;

        // Section title Create by language
        $sectiontitle = new Sectiontitle();
        $sectiontitle->language_id = $lang_id;
        $sectiontitle->trending_product_title = 'trending_product_title';
        $sectiontitle->trending_product_sub_title = 'trending_product_sub_title';

        $sectiontitle->product_title = 'product_title';
        $sectiontitle->product_sub_title = 'product_sub_title';

        $sectiontitle->blog_title = 'blog_title';
        $sectiontitle->blog_sub_title = 'blog_sub_title';

        $sectiontitle->newsletter_title = 'newsletter_title';
        $sectiontitle->newsletter_sub_title = 'newsletter_sub_title';
        $sectiontitle->save();

        // Settings Create by language
        $newlangsetting = new Setting();
        $newlangsetting->language_id = $lang_id;
        $newlangsetting->website_title = 'website_title';
        $newlangsetting->base_color = '983ce9';
        $newlangsetting->header_logo = 'header_logo';
        $newlangsetting->footer_logo = 'footer_logo';
        $newlangsetting->fav_icon = 'fav_icon';
        $newlangsetting->breadcrumb_image = 'breadcrumb_image';
        $newlangsetting->number = 'number';
        $newlangsetting->email = 'email';
        $newlangsetting->contactemail = 'contactemail';
        $newlangsetting->address = 'address';
        $newlangsetting->footer_text = 'footer_text';
        $newlangsetting->meta_keywords = 'meta_keywords';
        $newlangsetting->meta_description = 'meta_description';
        $newlangsetting->copyright_text = 'copyright_text';
        $newlangsetting->google_recaptcha_site_key = 'google_recaptcha_site_key';
        $newlangsetting->google_recaptcha_secret_key = 'google_recaptcha_secret_key';
        $newlangsetting->messenger = 'messenger';
        $newlangsetting->disqus = 'disqus';
        $newlangsetting->add_this_status = 'add_this_status';
        $newlangsetting->facebook_pexel = 'facebook_pexel';
        $newlangsetting->google_analytics = 'google_analytics';
        $newlangsetting->announcement = 'announcement';
        $newlangsetting->announcement_delay = 1;
        $newlangsetting->maintainance_text = 'maintainance_text';
        $newlangsetting->slider_overlay = 'slider_overlay';
        $newlangsetting->tawk_to = 'tawk_to';
        $newlangsetting->cookie_alert_text = 'cookie_alert_text';
        $newlangsetting->save();

        $notification = array(
          'messege' => 'Language added successfully!',
          'alert' => 'success'
        );
        return redirect()->route('admin.language.index')->with('notification', $notification);
    }

    public function edit($id)
    {
      $language = Language::findOrFail($id);

      return view('admin.language.edit-languages', compact('language'));

    }

    public function update(Request $request , $id)
    {

        $rules = [
            'name' => 'required|max:255',
            'code' => [
                'required',
                'max:255'
            ]
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
          $errmsgs = $validator->getMessageBag()->add('error', 'true');
          return response()->json($validator->errors());
        }

        $data = file_get_contents(resource_path('lang/') . 'default.json');
        $json_file = trim(strtolower($request->code)) . '.json';
        $path = resource_path('lang/') . $json_file;

        File::put($path, $data);

        $language = Language::findOrFail($id);


        $language->name = $request->name;
        $language->code = $request->code;
        $language->direction = $request->direction;
        $language->save();

        $notification = array(
          'messege' => 'Language updated successfully',
          'alert' => 'success'
        );
        return redirect()->route('admin.language.index')->with('notification', $notification);

    }

    public function editKeyword($id)
    {
      $la = Language::findOrFail($id);

      $page_title = "Update " . $la->name . " Language Keywords";

      $json = file_get_contents(resource_path('lang/') . $la->code . '.json');


      if (empty($json)) {
          return back()->with('warning', 'File Not Found.');
      }

        return view('admin.language.edit-keyword', compact('page_title', 'json', 'la'));
    }

    public function updateKeyword(Request $request, $id)
    {
        $lang = Language::findOrFail($id);
        $content = json_encode($request->keys);
        if ($content === 'null') {
            return back()->with('alert', 'At Least One Field Should Be Fill-up');
        }
        file_put_contents(resource_path('lang/') . $lang->code . '.json', $content);

        $notification = array(
          'messege' => 'Updated successfully',
          'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }


    public function delete($id)
    {
        $la = Language::findOrFail($id);
        if ($la->is_default == 1) {
          $notification = array(
            'messege' => 'Default language cannot be deleted!',
            'alert' => 'warning'
          );
          return back()->with('notification', $notification);
        }
        @unlink('assets/front/img/languages/' . $la->icon);
        @unlink(resource_path('lang/') . $la->code . '.json');
        if (session()->get('lang') == $la->code) {
          session()->forget('lang');
        }

        $sectiontitle = Sectiontitle::where('language_id', $id)->first();
        $sectiontitle->delete();
        $setting = Setting::where('language_id', $id)->first();
        $setting->delete();
        $la->delete();

        $notification = array(
          'messege' => 'Language Delete Successfully',
          'alert' => 'success'
        );
        return redirect()->route('admin.language.index')->with('notification', $notification);
    }

    public function default(Request $request, $id)
     {
      Language::where('is_default', 1)->update(['is_default' => 0]);
      $lang = Language::find($id);
      $lang->is_default = 1;
      $lang->save();

      $notification = array(
        'messege' => 'laguage is set as defualt.',
        'alert' => 'success'
      );

      return redirect()->route('admin.language.index')->with('notification', $notification);

    }


}
