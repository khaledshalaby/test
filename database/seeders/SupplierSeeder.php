<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SupplierClassification;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classifications = [

            [
                'name'=>'شركات',
            ],
            [
                'name'=>'مخازن',
            ],
            [
                'name'=>'اكسسوار',
            ]
        ];
        foreach($classifications as $cat){
            SupplierClassification::create($cat);
        }
    }
}
