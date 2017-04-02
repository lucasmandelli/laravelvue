<?php

namespace FinancialSystem\Repositories;

use FinancialSystem\Presenters\CategoryRevenuePresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use FinancialSystem\Repositories\CategoryRevenueRepository;
use FinancialSystem\Models\CategoryRevenue;

/**
 * Class CategoryRevenueRepositoryEloquent
 * @package namespace FinancialSystem\Repositories;
 */
class CategoryRevenueRepositoryEloquent extends BaseRepository implements CategoryRevenueRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CategoryRevenue::class;
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
        return CategoryRevenuePresenter::class;
    }

    public function create(array $attributes)
    {
        CategoryRevenue::$enableTenant = false;

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

        CategoryRevenue::$enableTenant = true;

        return $result;
    }

    public function update(array $attributes, $id)
    {
        CategoryRevenue::$enableTenant = false;

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

        CategoryRevenue::$enableTenant = true;

        return $result;
    }

}
