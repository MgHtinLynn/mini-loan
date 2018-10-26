<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Company Director','Loan Broker'];
        foreach ($roles as $role) {
            \App\Models\Role::query()->create(['role_name' => $role]);
        }

    }
}
