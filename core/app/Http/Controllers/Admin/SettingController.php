<?php

namespace App\Http\Controllers\Admin;

use App\Model\Setting;
use App\Model\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CookieRequest;
use App\Http\Requests\SeoinfoRequest;
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

    /**
     * section title page
     * @param Request $request
     * @return View
     */
    public function sectiontitle(Request $request)
    {
        $settingSectiontitle = $this->settingService->getSectionTitle($request->language);
        if(!$settingSectiontitle){
            $notification = $this->getNotificationMessage('Section Title Error!', 'error');
            return redirect()->back()->with('notification', $notification);
        }
        return view('admin.setting.sectiontitle', compact('settingSectiontitle'));
    }

    /**
     * update section title
     * @param SectiontitleRequest $request
     * @param Language $lang
     * @return redirect
     */
    public function updateSectiontitle(SectiontitleRequest $request , Language $lang)
    {
        $result = $this->settingService->updateSectionTitle($request,$lang->id);
        $notification = $this->getNotificationMessage('Section Titles & Subtitles Updated successfully!', 'success');
        if(!$result){
            $notification = $this->getNotificationMessage('Updating failed!', 'error');
        }
        return redirect(route('admin.sectiontitle'). '?language=' . $lang->code)->with('notification', $notification);
    }

    /**
     * seo info page
     * @param Request $request
     * @return View
     */
    public function seoinfo(Request $request)
    {
        $seoinfo = $this->settingService->getSetting($request->language);
        if(!$seoinfo){
            $notification = $this->getNotificationMessage('Seoinfo Error!', 'error');
            return redirect()->back()->with('notification', $notification);
        }
        return view('admin.setting.seoinfo', compact('seoinfo'));
    }

    /**
     * update Seo info page
     * @param Request $request
     * @return View
     */
    public function updateSeoinfo(SeoinfoRequest $request, Language $lang)
    {
        $result = $this->settingService->updateSeoInfo($request,$lang->id);
        $notification = $this->getNotificationMessage('Basic Info Updated successfully!', 'success');
        if(!$result){
        $notification = $this->getNotificationMessage('Basic Info Updating Failed!', 'error');
        }
        return redirect(route('admin.seoinfo') . '?language=' . $lang->code)->with('notification', $notification);
    }

    /**
     * scripts page
     * @return View|redirect
     */
    public function scripts()
    {
        $scripts = $this->settingService->getSetting();
        if(!$scripts){
            $notification = $this->getNotificationMessage('Scripts Error!', 'error');
            return redirect()->back()->with('notification', $notification);
        }
        return view('admin.setting.scripts', compact('scripts'));
    }

    /**
     * update scripts
     * @param Request $request
     * @return redirect
     */
    public function updateScript(Request $request)
    {
        $result = $this->settingService->updateScript($request);
        $notification = $this->getNotificationMessage('Scripts Updated successfully!', 'success');
        if(!$result){
            $notification = $this->getNotificationMessage('Scripts Updating failed', 'error');
        }
        return redirect(route('admin.scripts'))->with('notification', $notification);
    }

    /**
     * page visibility page
     * @return View
     */
    public function pagevisibility()
    {
        return view('admin.setting.page-visibility');
    }

    /**
     * update page visibility
     * @param Request $request
     * @return redirected
     */
    public function updatePagevisibility(Request $request)
    {
        $result = $this->settingService->updatePagevisibility($request);
        $notification = $this->getNotificationMessage('Page Visibility Updated successfully!', 'success');
        if(!$result){
            $notification = $this->getNotificationMessage('Page Visibility Updating Failed', 'error');
        }
        return redirect(route('admin.pagevisibility'))->with('notification', $notification);
    }

    /**
     * cookie alert page
     * @param Request $request
     * @return View
     */
    public function cookiealert(Request $request)
    {
        $cookiealert = $this->settingService->getSetting($request->language);
        if(!$cookiealert){
            $notification = $this->getNotificationMessage('Cookie alert Error!', 'error');
            return redirect()->back()->with('notification', $notification);
        }
        return view('admin.setting.cookie-alert', compact('cookiealert'));
    }

    /**
     * update cookie alert text
     * @param Request $request
     * @return View
     */
    public function updateCookiealert(CookieRequest $request, Language $lang)
    {
        $result = $this->settingService->updateCookiealert($request, $lang->id);
        $notification = $this->getNotificationMessage('Cookie Alert Text Updated successfully!', 'success');
        if(!$result){
            $notification = $this->getNotificationMessage('Cookie Alert Text Updating failed!', 'error');
        }
        return redirect(route('admin.cookiealert') . '?language=' . $lang->code)->with('notification', $notification);
    }

    /**
     * custom css file
     * @return View
     */
    public function customcss()
    {
        $custom_css = $this->settingService->getCustomCssFile();
        return view('admin.setting.custom-css')->with(['custom_css' => $custom_css]);
    }

    /**
     * update custom css file
     * @return View
     */
    public function updateCustomcss(Request $request)
    {
        $result = $this->settingService->updateCustomCss($request->custom_css_area);
        $notification = $this->getNotificationMessage('Custom Style Added successfully!', 'success');
        if(!$result){
            $notification = $this->getNotificationMessage('Custom Style Added failed!', 'error');
        }
        return redirect()->back()->with('notification', $notification);
    }
}
