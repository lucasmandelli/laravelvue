<?php

namespace FinancialSystem\Presenters;

use FinancialSystem\Transformers\BillPayTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BillPayPresenter
 *
 * @package namespace FinancialSystem\Presenters;
 */
class BillPayPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BillPayTransformer();
    }
}
