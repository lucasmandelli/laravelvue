<?php

namespace FinancialSystem\Transformers;

use League\Fractal\TransformerAbstract;
use FinancialSystem\Models\CategoryExpense;

/**
 * Class CategoryExpenseTransformer
 * @package namespace FinancialSystem\Transformers;
 */
class CategoryExpenseTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['children'];

    /**
     * Transform the \CategoryExpense entity
     * @param \CategoryExpense $model
     *
     * @return array
     */
    public function transform(CategoryExpense $model)
    {
        return [
            'id'         => (int) $model->id,

            'name' => $model->name,
            'parent_id' => $model->parent_id,
            'depth' => $model->depth,
            'type' => 'E',

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeChildren(CategoryExpense $model)
    {
        $children = $model->children()->withDepth()->get();
        return $this->collection($children, new CategoryExpenseTransformer());
    }
}
