<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		\App\Models\User::factory(10)->create();

		$user = \App\Models\User::create([
			'name' => 'Jesus Avelar',
			'username' => 'admin',
			'email_verified_at' => now(),
			'email' => 'admin@admin.com',
			'password' => bcrypt('123456')
		]);

		$user->assignRole('admin');
    }
}
