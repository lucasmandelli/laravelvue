<?php

namespace FinancialSystem\Presenters;

use FinancialSystem\Transformers\CategoryTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CategoryPresenter
 *
 * @package namespace FinancialSystem\Presenters;
 */
class CategoryPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CategoryTransformer();
    }
}
