<?php
namespace App\Services\Settings;

use App\Model\Setting;
use App\Model\Language;
use App\Model\Sectiontitle;
use Illuminate\Support\Facades\DB;

class SettingService{

    public function updateBasicinfo(string $website_title,string $address,int $lang_id): bool
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

    public function getSectionTitle($code): object
    {
        try {
            $lang = Language::where('code', $code)->first()->id;
            return Sectiontitle::where('language_id', $lang)->first();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateSectionTitle($request,$langId): bool
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

    public function getSetting($langCode): object
    {
        try {
            $lang = Language::where('code', $langCode)->first()->id;
            return Setting::where('language_id', $lang)->first();
        } catch (\Exception $e) {
            return false;
        }
    }

}
