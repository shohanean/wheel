<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;
use Carbon\Carbon;
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
            'name' => 'Shohan',
            'email' => 'shohan.cit.bd@gmail.com',
            'password' => Hash::make('creativefamily'),
            'created_at' => Carbon::now()
        ]);
    }
}
