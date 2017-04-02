<?php

namespace FinancialSystem\Presenters;

use FinancialSystem\Transformers\CategoryRevenueTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CategoryRevenuePresenter
 *
 * @package namespace FinancialSystem\Presenters;
 */
class CategoryRevenuePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CategoryRevenueTransformer();
    }
}
