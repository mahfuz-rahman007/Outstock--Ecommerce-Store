<?php

namespace App\Services\Settings;

use App\Model\Setting;
use App\Model\Language;
use App\Model\Sectiontitle;
use Illuminate\Support\Facades\DB;

class SettingService
{

    public function updateBasicinfo(string $website_title, string $address, int $lang_id): bool
    {
        try {
            DB::beginTransaction();
            Setting::where('language_id', $lang_id)->first()->update([
                'website_title' => $website_title,
                'address' => $address
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function updateCommoninfo(object $request): bool
    {
        try {
            DB::beginTransaction();
            $commonsetting = Setting::where('id', 1)->first();
            $path = 'assets/front/img';
            if ($request->hasFile('header_logo')) {
                $file = $request->file('header_logo');
                $header_logo = saveFile($file, 'header_logo', $commonsetting->header_logo, $path);
                $commonsetting->header_logo = $header_logo;
            }

            if ($request->hasFile('footer_logo')) {
                $file = $request->file('footer_logo');
                $footer_logo = saveFile($file, 'footer_logo', $commonsetting->footer_logo, $path);
                $commonsetting->footer_logo = $footer_logo;
            }

            if ($request->hasFile('fav_icon')) {
                $file = $request->file('fav_icon');
                $fav_icon = saveFile($file, 'fav_icon', $commonsetting->fav_icon, $path);
                $commonsetting->fav_icon = $fav_icon;
            }

            if ($request->hasFile('breadcrumb_image')) {
                $file = $request->file('breadcrumb_image');
                $breadcrumb_image = saveFile($file, 'breadcrumb_image', $commonsetting->breadcrumb_image, $path);
                $commonsetting->breadcrumb_image = $breadcrumb_image;
            }

            $commonsetting->number = $request->number;
            $commonsetting->email = $request->email;
            $commonsetting->contactemail = $request->contactemail;
            $commonsetting->base_color = $request->base_color;
            $commonsetting->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function getSectionTitle(string $code): object
    {
        try {
            $lang = Language::where('code', $code)->first()->id;
            return Sectiontitle::where('language_id', $lang)->first();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateSectionTitle(object $request, int $langId): bool
    {
        try {
            DB::beginTransaction();
            Sectiontitle::where('language_id', $langId)->first()->update([
                'trending_product_title' => $request->trending_product_title,
                'trending_product_sub_title' => $request->trending_product_sub_title,
                'product_title' => $request->product_title,
                'product_sub_title' => $request->product_sub_title,
                'blog_title' => $request->blog_title,
                'blog_sub_title' => $request->blog_sub_title,
                'newsletter_title' => $request->newsletter_title,
                'newsletter_sub_title' => $request->newsletter_sub_title
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function getSetting(string $langCode = null): object
    {
        try {
            return Setting::when($langCode, function ($query, $langCode) {
                $query->where('language_id', Language::where('code', $langCode)->first()->id);
            })->firstOrFail();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateSeoInfo(object $request, int $langId): bool
    {
        try {
            DB::beginTransaction();
            $seo = Setting::where('language_id', $langId)->first();
            $seo->meta_keywords = $request->meta_keywords;
            $seo->meta_description = $request->meta_description;
            $seo->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function updateScript(object $request): bool
    {
        try {
            DB::beginTransaction();
            Setting::firstOrFail()->update([
                'disqus' => $request->disqus,
                'tawk_to' => $request->tawk_to,
                'google_analytics' => $request->google_analytics,
                'messenger' => $request->messenger,
                'google_recaptcha_site_key' => $request->google_recaptcha_site_key,
                'google_recaptcha_secret_key' => $request->google_recaptcha_secret_key,
                'is_tawk_to' => $request->is_tawk_to == 'on' ? 1:0,
                'is_disqus' =>  $request->is_disqus == 'on' ? 1:0,
                'is_google_analytics' => $request->is_google_analytics == 'on' ? 1:0,
                'is_recaptcha' => $request->is_recaptcha == 'on' ? 1:0,
                'is_messenger' => $request->is_messenger == 'on' ? 1:0,
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function updatePagevisibility(object $request): bool
    {
        try {
            DB::beginTransaction();
            Setting::firstOrFail()->update([
                'is_hero_section' => $request->is_hero_section == 'on' ? 1:0,
                'is_trending_section' => $request->is_trending_section == 'on' ? 1:0,
                'is_ebanner_section' => $request->is_ebanner_section == 'on' ? 1:0,
                'is_product_section' => $request->is_product_section == 'on' ? 1:0,
                'is_client_section' => $request->is_client_section == 'on' ? 1:0,
                'is_blog_section' => $request->is_blog_section == 'on' ? 1:0,
                'is_newsletter_section' => $request->is_newsletter_section == 'on' ? 1:0,
                'is_shop_page' => $request->is_shop_page == 'on' ? 1:0,
                'is_blog_page' => $request->is_blog_page == 'on' ? 1:0,
                'is_contact_page' => $request->is_contact_page == 'on' ? 1:0,
                'is_cooki_alert' => $request->is_cooki_alert == 'on' ? 1:0,
                'is_hero_section' => $request->is_hero_section == 'on' ? 1:0,
                'is_hero_section' => $request->is_hero_section == 'on' ? 1:0
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function updateCookiealert(object $request , int $langId):bool
    {
        try {
            DB::beginTransaction();
            Setting::where('language_id', $langId)->first()->update([
                'cookie_alert_text' => $request->cookie_alert_text
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function getCustomCssFile():string
    {
        $custom_css = '/* Write Custom Css Here */';
        if (file_exists('assets/front/css/dynamic-css.css')) {
            $custom_css = file_get_contents('assets/front/css/dynamic-css.css');
        }
        return $custom_css;
    }

    public function updateCustomCss(string $css):bool
    {
        return file_put_contents('assets/front/css/dynamic-css.css', $css);
    }
}
