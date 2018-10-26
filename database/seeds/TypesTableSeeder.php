<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['I need a business loan', 'I need a personal loan', 'I need an advance against an invoice', 'I need funds to start my business'];
        foreach ($types as $type) {
            \App\Models\LoanType::query()->create(['loan_type_name' => $type]);
        }
    }
}
