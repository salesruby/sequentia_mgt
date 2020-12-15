<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = \App\Role::where('name', 'admin')->first();

        \App\User::create([
            'first_name' => 'Sequentia',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '0813822658',
            'password' => bcrypt('12345678'),
            'role_id' => $role->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
