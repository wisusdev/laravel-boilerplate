<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        Setting::insert([
            [ 'key' => 'theme_active', 'value' => 'default'],
            [ 'key' => 'logo', 'value' => '' ],
            [ 'key' => 'favicon', 'value' => '' ],
            [ 'key' => 'email_address', 'value' => '' ],
            [ 'key' => 'keyword', 'value' => '' ],
            [ 'key' => 'site_description', 'value' => '' ],
            [ 'key' => 'google_analytics', 'value' => '' ],
            [ 'key' => 'robots', 'value' => '' ],
            [ 'key' => 'main_page', 'value' => '' ],
            [ 'key' => 'main_menu', 'value' => 1 ],
            [ 'key' => 'app_lang', 'value' => 'es'],
            [ 'key' => 'currency_code', 'value' => 'USD' ],
        ]);
    }
}
