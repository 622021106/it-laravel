<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
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
        $data = [
            DB::table('users')->insert([
            [
                'name' => 'Sirapop Sriyotha',
                'email' => '622021106@tsu.ac.th',
                'password' => Hash::make('123456'),
                'address' => 'TSU',
                'create_at' => Carbon::now(),
                'upgrade_at' => Carbon::now(),
            ],
            [
                'name' => 'John Bravo',
                'email' => 'John@tsu.ac.th',
                'password' => Hash::make('123456'),
                'address' => 'TSU',
                'create_at' => Carbon::now(),
                'upgrade_at' => Carbon::now(),
            ],
            [
                'name' => 'Chris Brown',
                'email' => 'Chris@tsu.ac.th',
                'password' => Hash::make('123456'),
                'address' => 'TSU',
                'create_at' => Carbon::now(),
                'upgrade_at' => Carbon::now(),
            ],
            ])
        ];
        DB::table('user')->insert($data);
            
    }
}
