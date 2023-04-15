<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'       => 'Tarek Mohajer',
            'email'      => 'tarek@growmemarketing.ca',
            'password'   => Hash::make('awesomeness')
        ]);
    }
}
