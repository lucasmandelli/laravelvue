<?php

namespace FinancialSystem\Repositories;

use FinancialSystem\Presenters\CategoryPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use FinancialSystem\Repositories\CategoryRepository;
use FinancialSystem\Models\Category;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace FinancialSystem\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
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
        return CategoryPresenter::class;
    }

    public function create(array $attributes)
    {
        if(isset($attributes['parent_id'])) {

            $skipPresenter = $this->skipPresenter;
            $this->skipPresenter(true);

            $parent = $this->find($attributes['parent_id']);

            $this->skipPresenter = $skipPresenter;

            $child = $parent->children()->create($attributes);

            return $this->parserResult($child);

        }else {

            return parent::create($attributes);

        }
    }

    public function update(array $attributes, $id)
    {
        if(isset($attributes['parent_id'])) {

            $skipPresenter = $this->skipPresenter;
            $this->skipPresenter(true);

            $child = $this->find($id);
            $child->name = $attributes['name'];
            $child->parent_id = $attributes['parent_id'];
            $child->save();

            $this->skipPresenter = $skipPresenter;

            return $this->parserResult($child);

        }else {

            return parent::update($attributes);

        }
    }
}
