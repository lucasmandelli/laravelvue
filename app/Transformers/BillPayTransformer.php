<?php

namespace FinancialSystem\Transformers;

use League\Fractal\TransformerAbstract;
use FinancialSystem\Models\BillPay;

/**
 * Class BillPayTransformer
 * @package namespace FinancialSystem\Transformers;
 */
class BillPayTransformer extends TransformerAbstract
{

    /**
     * Transform the \BillPay entity
     * @param \BillPay $model
     *
     * @return array
     */
    public function transform(BillPay $model)
    {
        return [
            'id' => (int) $model->id,
            'date_due' => $model->date_due->format('d/m/Y'),
            'name' => $model->name,
            'value' => money_format('%+-.2i', $model->value),
            'done' => (bool) $model->done,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
