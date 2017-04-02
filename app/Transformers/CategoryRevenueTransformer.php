<?php

namespace FinancialSystem\Transformers;

use League\Fractal\TransformerAbstract;
use FinancialSystem\Models\CategoryRevenue;

/**
 * Class CategoryRevenueTransformer
 * @package namespace FinancialSystem\Transformers;
 */
class CategoryRevenueTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['children'];

    /**
     * Transform the \CategoryRevenue entity
     * @param \CategoryRevenue $model
     *
     * @return array
     */
    public function transform(CategoryRevenue $model)
    {
        return [
            'id'         => (int) $model->id,

            'name' => $model->name,
            'parent_id' => $model->parent_id,
            'depth' => $model->depth,
            'type' => 'R',

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeChildren(CategoryRevenue $model)
    {
        $children = $model->children()->withDepth()->get();
        return $this->collection($children, new CategoryRevenueTransformer());
    }
}
