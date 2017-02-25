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

        $clientRepository = app(\FinancialSystem\Repositories\ClientRepository::class);
        $clients = $clientRepository->all();

        factory(\FinancialSystem\Models\User::class, 1)
            ->states('admin')
            ->create([
                'name' => 'Lucas Mandelli',
                'email' => 'admin@user.com'
            ]);

        foreach (range(1, 50) as $num) {
            factory(\FinancialSystem\Models\User::class, 1)
                ->create([
                    'name' => "Cliente $num",
                    'email' => "client$num@user.com"
                ])
                ->each(function ($user) use($clients) {
                    $client = $clients->random();
                    $user->client()->associate($client);
                    $user->save();
                });
        }
    }
}
