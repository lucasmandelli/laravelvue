<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    use \FinancialSystem\Repositories\GetClientsTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $clients = $this->getClients();

        factory(\FinancialSystem\Models\Category::class, 30)
            ->make()
            ->each(function($category) use($clients) {
                $client = $clients->random();

                $category->client_id = $client->id;
                $category->save();

            });

        $categoriesRoot = $this->getCategoriesRoot();

        foreach ($categoriesRoot as $categoryRoot) {

            factory(\FinancialSystem\Models\Category::class, 3)
                ->make()
                ->each(function($categoryChild) use($categoryRoot) {

                    $categoryChild->client_id = $categoryRoot->client_id;
                    $categoryChild->save();

                    $categoryChild->parent()->associate($categoryRoot);
                    $categoryChild->save();

                });

        }

    }

    private function getCategoriesRoot()
    {
        /** @var \FinancialSystem\Repositories\BankRepository $bankRepository */
        $categoriesRepository = app(\FinancialSystem\Repositories\CategoryRepository::class);
        $categoriesRepository->skipPresenter(true);

        return $categoriesRepository->all();
    }
}
