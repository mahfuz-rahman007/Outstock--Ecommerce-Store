<?php

namespace App\Providers;

use App\Admin;
use App\Model\Social;
use App\Model\Setting;
use App\Model\Language;
use App\Model\Dynamicpage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            // $adminprofile = Admin::first();
            $socials = Social::get();
            $commonsetting = Setting::where('id', 1)->first();


            $lang = Language::where('is_default', '1')->first();
            // $setting = Setting::where('language_id', $lang->id)->first();



            if (session()->has('lang')) {
                $currentLang = Language::where('code', session()->get('lang'))->first();

                $setting = Setting::where('language_id', $currentLang->id)->first();
                $front_dynamic_pages = Dynamicpage::where('status', 1)->where('language_id', $currentLang->id)->orderBy('id', 'DESC')->get();

                $view->with('setting', $setting);

                $view->with('currentLang', $currentLang);
                $view->with('front_dynamic_pages', $front_dynamic_pages);
            } else {
                $currentLang = Language::where('is_default', 1)->first();

                $setting = Setting::where('language_id', $currentLang->id)->first();
                $front_dynamic_pages = Dynamicpage::where('status', 1)->where('language_id', $currentLang->id)->orderBy('id', 'DESC')->get();

                $view->with('setting', $setting);

                $view->with('currentLang', $currentLang);
                $view->with('front_dynamic_pages', $front_dynamic_pages);
            }



            $langs = Language::all();
            $view->with('langs', $langs);
            $view->with('lang', $lang);
            $view->with('socials', $socials);
            $view->with('commonsetting', $commonsetting);
            // $view->with('adminprofile', $adminprofile);

        });
    }
}
