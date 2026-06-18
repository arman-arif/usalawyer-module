<?php

namespace App\Modules\Lawyer\Database\Seeders;

use App\Models\Core\ApplicationSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class ApplicationSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $this->updateDefaultSettings();

        $color_palettes = ApplicationSetting::where('slug', 'color_palette')->value('value');
        $color_palettes = json_decode($color_palettes, true);

        foreach($color_palettes as $key => &$color_palette){
            $color_palette['is_default'] = $key == THEME_PURPLE;
        }

        $adminSettingArray = [
            'color_palette' => $color_palettes,
            'default_home_page_route'=> 'lawyer.index',
            'support_email' => '',
            'display_google_captcha' => ACTIVE,
            'company_name' => 'USA Lawyer Directory',
            'company_email' => '',
        ];

        $this->setApplicationSettings($adminSettingArray);
    }

    public function setApplicationSettings(array $adminSettingArray): void
    {
        foreach ($adminSettingArray as $key => $value) {
            ApplicationSetting::updateOrCreate(
                ['slug' => $key],
                ['value' => is_array($value) ? json_encode($value) : $value]
            );
        }

        $cached = cache('appSettings', []);
        $merged = array_merge($cached, $adminSettingArray);
        Cache::forever('appSettings', $merged);
    }

    private function updateDefaultSettings(): void
    {
        $adminSettingArray = [
            'lang' => 'en',
            'lang_switcher' => INACTIVE,
            'lang_switcher_item' => 'icon',
            'registration_active_status' => INACTIVE,
            'default_role_to_register' => USER_ROLE_USER,
            'require_email_verification' => ACTIVE,
            'navigation_type' => 2,
            'favicon' => 'favicon.png',
            'sidebar_logo' => 'logo.png',
            'top_header_logo' => 'logo.png',
            'maintenance_mode' => 0,
            'fullwidth_topnav' => 1,
            'company_appointments_phone' => '',
            'company_emergency_phone' => '',
            'company_open_date' => '',
            'company_close_date' => '',
            'company_weak_off_days' => '',
            'company_facebook' => '',
            'company_linkedin' => '',
            'company_instagram' => '',
            'company_address' => '',
            'company_google_map_url' => '',
            'company_copyright' => 'All Rights Reserved | Powered by <a href="javascript:;">USA Lawyer Directory</a>',
        ];

        $adminSetting = [];
        foreach ($adminSettingArray as $key => $value) {
            $adminSetting[] = [
                'slug' => $key,
                'value' => is_array($value) ? json_encode($value) : $value,
            ];
        }
        ApplicationSetting::upsert($adminSetting, ['slug']);

        Cache::forever("appSettings", $adminSettingArray);
    }
}
