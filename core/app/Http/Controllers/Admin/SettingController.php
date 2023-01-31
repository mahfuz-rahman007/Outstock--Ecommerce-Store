<?php

namespace App\Http\Controllers\Admin;

use App\Model\Setting;
use App\Model\Language;
use App\Model\Sectiontitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BasicinfoRequest;
use App\Http\Requests\CommoninfoRequest;
use App\Services\Settings\SettingService;
use App\Http\Requests\SectiontitleRequest;

class SettingController extends Controller
{
    public $lang;
    public function __construct(public SettingService $settingService )
    {
        $this->lang = Language::where('is_default', 1)->first();
    }

    /**
     * basic info page
     * @param Request $request
     * @return view
     */
    public function basicinfo(Request $request)
    {
        $lang = Language::where('code', $request->language)->first()->id;
        $basicinfo = Setting::where('language_id', $lang)->first();
        $commonsetting = Setting::where('id', 1)->first();
        return view('admin.setting.basicinfo', compact('basicinfo', 'commonsetting'));
    }

    /**
     * update info page
     * @param BasicinfoRequest $request
     * @param Language $lang
     * @return redirect
     */
    public function updateBasicinfo(BasicinfoRequest $request, Language $lang)
    {
        $result = $this->settingService->updateBasicinfo($request->website_title, $request->address, $lang->id);
        $notification = $this->getNotificationMessage('Basic Info Updated successfully!', 'success');
        if (!$result) {
            $notification = $this->getNotificationMessage('Basic Info Updated Failed!', 'error');
        }
        return redirect(route('admin.setting.basicinfo') . '?language=' . $lang->code)->with('notification', $notification);
    }

    /**
     * update common page
     * @param CommoninfoRequest $request
     * @return redirect
     */
    public function updateCommoninfo(CommoninfoRequest $request)
    {
        $result = $this->settingService->updateCommoninfo($request);
        $notification = $this->getNotificationMessage('Commoninfo Updated successfully!', 'success');
        if(!$result){
            $notification = $this->getNotificationMessage('Commoninfo Updating failed!', 'error');
        }
        return redirect(route('admin.setting.basicinfo') . '?language=' . $this->lang->code)->with('notification', $notification);
    }

    public function sectiontitle(Request $request)
    {
        $sectiontitle = $this->settingService->getSectionTitle($request->language);
        if(!$sectiontitle){
            $notification = $this->getNotificationMessage('Section Title Error!', 'error');
            return redirect()->back()->with('notification', $notification);
        }
        return view('admin.setting.sectiontitle', compact('sectiontitle'));
    }

    public function updateSectiontitle(SectiontitleRequest $request , Language $lang)
    {
        $result = $this->settingService->updateSectionTitle($request,$lang->id);
        $notification = $this->getNotificationMessage('Section Titles & Subtitles Updated successfully!', 'success');
        if(!$result){
            $notification = $this->getNotificationMessage('Updating failed!', 'error');
        }
        return redirect(route('admin.sectiontitle'). '?language=' . $lang->code)->with('notification', $notification);
    }

    public function seoinfo(Request $request)
    {
        $seoinfo = $this->settingService->getSetting($request->language);
        if(!$seoinfo){
            $notification = $this->getNotificationMessage('Seoinfo Error!', 'error');
            return redirect()->back()->with('notification', $notification);
        }
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
