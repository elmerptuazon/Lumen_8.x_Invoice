<?php

namespace Database\Seeders;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();
        DB::table('users')->delete();

        User::create([
            'name' => 'demo',
            'email' => 'demo@sample.com',
            'password' => Hash::make('secret'),
            'api_key' => ''
        ]);
        // Model::reguard();
    }
}
