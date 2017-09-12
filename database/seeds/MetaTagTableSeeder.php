<?php

use Illuminate\Database\Seeder;

class MetaTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meta_tags = [
            [
                'client_id' => 1,
                'type' => 'Belrose Super Centre',
                'site_name' => 'og',
                'title' => 'Belrose Super Centre - The ultimate homemaker and lifestyle shopping centre',
                'image' => '/image/belrose/meta-tag.png',
                'image_width' => '461',
                'image_height' => '865',
                'description' => 'The ultimate homemaker and lifestyle shopping centre',
                'keywords' => 'Shop, Bedding, Furniture, Bedding & Furniture,Home Decorating, Gifts, Outdoor living, Pets',
                'url' => 'http://bsc.mallrewards.com.au'
            ],
            [
                'client_id' => 1,
                'type' => 'Belrose Super Centre',
                'site_name' => 'site',
                'title' => 'Belrose Super Centre - The ultimate homemaker and lifestyle shopping centre',
                'image' => '/image/belrose/meta-tag.png',
                'image_width' => '461',
                'image_height' => '865',
                'description' => 'The ultimate homemaker and lifestyle shopping centre',
                'keywords' => 'Shop, Bedding, Furniture, Bedding & Furniture,Home Decorating, Gifts, Outdoor living, Pets',
                'url' => 'http://bsc.mallrewards.com.au'
            ]
        ];

        DB::table('meta_tags')->truncate();
        DB::table('meta_tags')->insert($meta_tags);
    }
}
