<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::setMany([
            'default_locale'       => 'ar',
            'default_timezone'     => 'Africa/Cairo',
            'reviews_enabled'      => true,
            'auto_approve_reviews' => true,
            'supported_currencies' => ['USD', 'LE', 'SAR'],
            'default_currency'     => 'USD',
            'store_email'          => 'admin@store.com',
            'search_engine'        => 'mysql',
            'local_shipping'       => 0,
            'outer_shipping'       => 0,
            'free_shipping'        => 0,
            'translatable' => [
                'store_name'          => 'متجر بيتر',
                'free_shipping_label' => 'توصيل مجاني',
                'local_label'         => 'توصيل داخلي',
                'outer_label'         => 'توصيل خارجي',
            ]
        ]);
    }
}
