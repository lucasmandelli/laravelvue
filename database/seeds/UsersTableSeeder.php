<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\FinancialSystem\Models\User::class, 1)
            ->states('admin')
            ->create([
                'name' => 'Lucas Mandelli',
                'email' => 'admin@user.com'
            ]);

        factory(\FinancialSystem\Models\User::class, 1)
            ->create([
                'name' => 'Cliente 1',
                'email' => 'client@user.com'
            ]);
    }
}
