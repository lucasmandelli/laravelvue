<?php

namespace FinancialSystem\Repositories;

use FinancialSystem\Presenters\CategoryExpensePresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use FinancialSystem\Repositories\CategoryExpenseRepository;
use FinancialSystem\Models\CategoryExpense;

/**
 * Class CategoryExpenseRepositoryEloquent
 * @package namespace FinancialSystem\Repositories;
 */
class CategoryExpenseRepositoryEloquent extends BaseRepository implements CategoryExpenseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CategoryExpense::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return mixed
     */
    public function presenter()
    {
        return CategoryExpensePresenter::class;
    }

    public function create(array $attributes)
    {
        CategoryExpense::$enableTenant = false;

        if(isset($attributes['parent_id'])) {

            $skipPresenter = $this->skipPresenter;
            $this->skipPresenter(true);

            $parent = $this->find($attributes['parent_id']);

            $this->skipPresenter = $skipPresenter;

            $child = $parent->children()->create($attributes);

            $result = $this->parserResult($child);

        }else {

            $result = parent::create($attributes);

        }

        CategoryExpense::$enableTenant = true;

        return $result;
    }

    public function update(array $attributes, $id)
    {
        CategoryExpense::$enableTenant = false;

        if(isset($attributes['parent_id'])) {

            $skipPresenter = $this->skipPresenter;
            $this->skipPresenter(true);

            $child = $this->find($id);
            $child->fill($attributes);
            $child->parent_id = $attributes['parent_id'];
            $child->save();

            $this->skipPresenter = $skipPresenter;

            $result = $this->parserResult($child);

        }else {

            $result = parent::update($attributes, $id);

            $result->makeRoot()->save(); // se não tiver parent transforma em pai

        }

        CategoryExpense::$enableTenant = true;

        return $result;
    }

}
