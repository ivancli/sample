<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
            'segment' => 'belrose',
            'name' => 'Belrose Super Centre',
            'layout_html' => trim('
                <div class="container"></div>
            '),
            'layout_non_auth_html' => trim('
                <div class="container"></div>
            '),
            'base_url' => 'http://receipt-microsite.dev/',
            'css' => '/css/belrose.css',
            'banner' => '/images/belrose/banner.jpg',
            'client_logo' => '/images/belrose/logo.png',
            'apple_touch_icon' => '/images/belrose/manly-apple-icon-',
            'favicon' => '/images/belrose/favicon.ico',
            'sprooki_endpoint' => 'http://labs.apisp86.sprookimanagerx.com',
            'sprooki_publickey' => '33ec23e8c8ff5d52aaace419367125ee',
            'sprooki_privatekey' => '519c89635415ddf29beb911cdd69ca56',
            'sprooki_api_version' => '2.3'
        ];

//        DB::table('clients')->truncate();
        DB::table('clients')->insert($clients);
    }
}
