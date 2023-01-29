<?php
namespace App\Services\Settings;

use App\Model\Setting;
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
                $breadcrumb_image = 'breadcrumb_image_'.time(). '.' . $extension;
                $file->move('assets/front/img/', $breadcrumb_image);
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

}
