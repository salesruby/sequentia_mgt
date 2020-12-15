<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'admin', 'description' => 'Application administrator'],
            ['name' => 'user', 'description' => 'Application user']
        ];

        foreach ($roles as $role){
            \App\Role::create(['name' => $role['name'], 'description' => $role['description']]);
        }
    }
}
