<?php

namespace Database\Seeders;

// use App\Models\Settings;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //elequent
        //query builder
        //::
        Settings::create([
            'app_name' => 'Point Of Sales | PPKDJP',
            'address' => 'Jl.Karet Baru',
            'phone_number' => '323 - 3232 - 3233'
        ]);
        // DB::table('settings')->create([]);
        //$setting = new\App\Models\Settings;
        // $setting->app_name ="Wilda";
        // $setting->save();
    }
}
