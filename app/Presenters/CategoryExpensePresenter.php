<?php

namespace FinancialSystem\Presenters;

use FinancialSystem\Transformers\CategoryExpenseTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CategoryExpensePresenter
 *
 * @package namespace FinancialSystem\Presenters;
 */
class CategoryExpensePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CategoryExpenseTransformer();
    }
}
