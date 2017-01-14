<?php

namespace FinancialSystem\Repositories;

use FinancialSystem\Presenters\BillPayPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use FinancialSystem\Models\BillPay;

/**
 * Class BillPayRepositoryEloquent
 * @package namespace FinancialSystem\Repositories;
 */
class BillPayRepositoryEloquent extends BaseRepository implements BillPayRepository
{

    protected $fieldSearchable = [
        'date_due' => 'like',
        'name' => 'like',
        'value' => 'like',
        'done'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BillPay::class;
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
        return BillPayPresenter::class;
    }
}
