<?php

namespace App\Http\Controllers\Admin;

use App\Model\Setting;
use App\Model\Language;
use App\Model\Sectiontitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public $lang;
    public function __construct()
    {
        $this->lang = Language::where('is_default', 1)->first();
    }

    public function basicinfo(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;
        $basicinfo = Setting::where('language_id', $lang)->first();
        $commonsetting = Setting::where('id', 1)->first();

        return view('admin.setting.basicinfo', compact('basicinfo', 'commonsetting'));
    }

    public function updateBasicinfo(Request $request, $id)
    {
        $lang = Language::where('id', $id)->first();
        $request->validate([
            'website_title'  => 'required|max:255',
            'address'  => 'required|max:255'
        ]);

        $basicinfo = Setting::where('language_id', $id)->first();

        $basicinfo->website_title = $request->website_title;
        $basicinfo->address = $request->address;
        $basicinfo->save();


        $notification = array(
            'messege' => 'Basic Info Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.setting.basicinfo') . '?language=' . $lang->code)->with('notification', $notification);
    }

    public function updateCommoninfo(Request $request)
    {

        $request->validate([
            'number' => 'required|max:250',
            'email' => 'required|max:250',
            'contactemail' => 'required|max:250',
            'base_color' => 'required',
            'header_logo' => 'mimes:jpeg,jpg,png',
            'footer_logo' => 'mimes:jpeg,jpg,png',
            'fav_icon' => 'mimes:jpeg,jpg,png',
            'breadcrumb_image' => 'mimes:jpeg,jpg,png'
        ]);


        $commonsetting = Setting::where('id', 1)->first();

        if ($request->hasFile('header_logo')) {
            @unlink('assets/front/img/' . $commonsetting->header_logo);
            $file = $request->file('header_logo');
            $extension = $file->getClientOriginalExtension();
            $header_logo = 'header_logo_' . time() . rand() . '.' . $extension;
            $file->move('assets/front/img/', $header_logo);
            $commonsetting->header_logo = $header_logo;
        }

        if ($request->hasFile('footer_logo')) {
            @unlink('assets/front/img/' . $commonsetting->footer_logo);
            $file = $request->file('footer_logo');
            $extension = $file->getClientOriginalExtension();
            $footer_logo = 'footer_logo' . time() . rand() . '.' . $extension;
            $file->move('assets/front/img/', $footer_logo);
            $commonsetting->footer_logo = $footer_logo;
        }

        if ($request->hasFile('fav_icon')) {
            @unlink('assets/front/img/' . $commonsetting->fav_icon);
            $file = $request->file('fav_icon');
            $extension = $file->getClientOriginalExtension();
            $fav_icon = 'fav_icon_' . time() . rand() . '.' . $extension;
            $file->move('assets/front/img/', $fav_icon);
            $commonsetting->fav_icon = $fav_icon;
        }

        if ($request->hasFile('breadcrumb_image')) {
            @unlink('assets/front/img/' . $commonsetting->breadcrumb_image);
            $file = $request->file('breadcrumb_image');
            $extension = $file->getClientOriginalExtension();
            $breadcrumb_image = 'breadcrumb_image_' . '.' . $extension;
            $file->move('assets/front/img/', $breadcrumb_image);
            $commonsetting->breadcrumb_image = $breadcrumb_image;
        }

        $commonsetting->number = $request->number;
        $commonsetting->email = $request->email;
        $commonsetting->contactemail = $request->contactemail;

        $new_base_color = ltrim($request->base_color, '#');
        $commonsetting->base_color = $new_base_color;


        $commonsetting->save();

        $notification = array(
            'messege' => 'Basic Info Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.setting.basicinfo') . '?language=' . $this->lang->code)->with('notification', $notification);
    }
    public function sectiontitle(Request $request)
    {

        $lang = Language::where('code', $request->language)->first()->id;
        $sectiontitle = Sectiontitle::where('language_id', $lang)->first();

        return view('admin.setting.sectiontitle', compact('sectiontitle'));

    }

    public function updateSectiontitle(Request $request , $id)
    {
        $request->validate([

            "trending_product_title"   => "required|max:150",
            "trending_product_sub_title"  => "required|max:300",

            "product_title"  => "required|max:150",
            "product_sub_title"  => "required|max:300",

            "blog_title"  => "required|max:150",
            "blog_sub_title"  => "required|max:300",

            "newsletter_title"  => "required|max:150",
            "newsletter_sub_title"  => "required|max:300",

        ]);

        $lang = Language::where('id', $id)->first();

        $sectiontitle = Sectiontitle::where('language_id', $id)->first();


        $sectiontitle->trending_product_title = $request->trending_product_title;
        $sectiontitle->trending_product_sub_title = $request->trending_product_sub_title;

        $sectiontitle->product_title = $request->product_title;
        $sectiontitle->product_sub_title = $request->product_sub_title;

        $sectiontitle->blog_title = $request->blog_title;
        $sectiontitle->blog_sub_title = $request->blog_sub_title;

        $sectiontitle->newsletter_title = $request->newsletter_title;
        $sectiontitle->newsletter_sub_title = $request->newsletter_sub_title;

        $sectiontitle->save();

        $notification = array(
            'messege' => 'Section Titles & Subtitles Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.sectiontitle'). '?language=' . $lang->code)->with('notification', $notification);

    }

    public function seoinfo(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;
        $seoinfo = Setting::where('language_id', $lang)->first();

        return view('admin.setting.seoinfo', compact('seoinfo'));
    }

    public function updateSeoinfo(Request $request, $id)
    {

        $request->validate([
            'meta_keywords' => 'required',
            'meta_description' => 'required'
        ]);

        $lang = Language::where('id', $id)->first();
        $seo = Setting::where('language_id', $id)->first();

        $seo->meta_keywords = $request->meta_keywords;
        $seo->meta_description = $request->meta_description;
        $seo->save();

        $notification = array(
            'messege' => 'Basic Info Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.seoinfo') . '?language=' . $lang->code)->with('notification', $notification);
    }

    public function scripts()
    {
        $scripts = Setting::where('id', '1')->first();

        return view('admin.setting.scripts', compact('scripts'));
    }

    public function updateScript(Request $request)
    {

        $scripts = Setting::where('id', '1')->first();


        $scripts->disqus = $request->disqus;
        $scripts->tawk_to = $request->tawk_to;
        $scripts->google_analytics = $request->google_analytics;
        $scripts->messenger = $request->messenger;
        $scripts->google_recaptcha_site_key = $request->google_recaptcha_site_key;
        $scripts->google_recaptcha_secret_key = $request->google_recaptcha_secret_key;



        if($request->is_tawk_to == 'on'){
           $scripts->is_tawk_to = 1;
        }else{
           $scripts->is_tawk_to = 0;
        }

        if($request->is_disqus == 'on'){
           $scripts->is_disqus = 1;
        }else{
           $scripts->is_disqus = 0;
        }

        if($request->is_google_analytics == 'on'){
           $scripts->is_google_analytics = 1;
        }else{
           $scripts->is_google_analytics = 0;
        }

        if($request->is_recaptcha == 'on'){
           $scripts->is_recaptcha = 1;
        }else{
           $scripts->is_recaptcha = 0;
        }

        if($request->is_messenger == 'on'){
           $scripts->is_messenger = 1;
        }else{
           $scripts->is_messenger = 0;
        }

        $scripts->save();

        $notification = array(
            'messege' => 'Scripts Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.scripts'))->with('notification', $notification);
    }

    public function pagevisibility()
    {

        return view('admin.setting.page-visibility');
    }

    public function updatePagevisibility(Request $request)
    {
        $pagevisibility = Setting::where('id', '1')->first();

        if ($request->is_hero_section == 'on') {
            $pagevisibility->is_hero_section = 1;
        } else {
            $pagevisibility->is_hero_section = 0;
        }

        if ($request->is_trending_section == 'on') {
            $pagevisibility->is_trending_section = 1;
        } else {
            $pagevisibility->is_trending_section = 0;
        }

        if ($request->is_ebanner_section == 'on') {
            $pagevisibility->is_ebanner_section = 1;
        } else {
            $pagevisibility->is_ebanner_section = 0;
        }

        if ($request->is_product_section == 'on') {
            $pagevisibility->is_product_section = 1;
        } else {
            $pagevisibility->is_product_section = 0;
        }

        if ($request->is_client_section == 'on') {
            $pagevisibility->is_client_section = 1;
        } else {
            $pagevisibility->is_client_section = 0;
        }

        if ($request->is_blog_section == 'on') {
            $pagevisibility->is_blog_section = 1;
        } else {
            $pagevisibility->is_blog_section = 0;
        }

        if ($request->is_newsletter_section == 'on') {
            $pagevisibility->is_newsletter_section = 1;
        } else {
            $pagevisibility->is_newsletter_section = 0;
        }

        if ($request->is_shop_page == 'on') {
            $pagevisibility->is_shop_page = 1;
        } else {
            $pagevisibility->is_shop_page = 0;
        }


        if ($request->is_blog_page == 'on') {
            $pagevisibility->is_blog_page = 1;
        } else {
            $pagevisibility->is_blog_page = 0;
        }

        if ($request->is_contact_page == 'on') {
            $pagevisibility->is_contact_page = 1;
        } else {
            $pagevisibility->is_contact_page = 0;
        }




        if ($request->is_cooki_alert == 'on') {
            $pagevisibility->is_cooki_alert = 1;
        } else {
            $pagevisibility->is_cooki_alert = 0;
        }


        $pagevisibility->save();

        $notification = array(
            'messege' => 'Page Visibility Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.pagevisibility'))->with('notification', $notification);
    }

    public function cookiealert(Request $request)
    {

        $lang = Language::where('code', $request->language)->first()->id;
        $cookiealert = Setting::where('language_id', $lang)->first();

        return view('admin.setting.cookie-alert', compact('cookiealert'));
    }

    public function updateCookiealert(Request $request, $id)
    {

        $request->validate([
            'cookie_alert_text' => 'required'
        ]);


        $lang = Language::where('id', $id)->first();
        $cookiealert = Setting::where('language_id', $id)->first();

        $cookiealert->cookie_alert_text = $request->cookie_alert_text;
        $cookiealert->save();

        $notification = array(
            'messege' => 'Cookie Alert Text Updated successfully!',
            'alert' => 'success'
        );
        return redirect(route('admin.cookiealert') . '?language=' . $lang->code)->with('notification', $notification);
    }

    public function customcss()
    {
        $custom_css = '/* Write Custom Css Here */';

        if (file_exists('assets/front/css/dynamic-css.css')) {
            $custom_css = file_get_contents('assets/front/css/dynamic-css.css');
        }
        return view('admin.setting.custom-css')->with(['custom_css' => $custom_css]);
    }

    public function updateCustomcss(Request $request)
    {
        file_put_contents('assets/front/css/dynamic-css.css', $request->custom_css_area);

        $notification = array(
            'messege' => 'Custom Style Added Success!',
            'alert' => 'success'
        );
        return redirect()->back()->with('notification', $notification);
    }
}
