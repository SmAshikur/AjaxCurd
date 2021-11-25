<?php

namespace Database\Seeders;

use App\Models\Ajax;
use Illuminate\Database\Seeder;

class ajaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rec=[
            ['name'=>'king','address'=>'savar'],
            ['name'=>'king','address'=>'savar'],
            ['name'=>'king','address'=>'savar'],
            ['name'=>'king','address'=>'savar'],
        ];
        Ajax::insert($rec);
    }
}
