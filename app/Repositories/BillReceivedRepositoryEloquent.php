<?php

namespace FinancialSystem\Repositories;

use FinancialSystem\Presenters\BillReceivedPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use FinancialSystem\Models\BillReceived;

/**
 * Class BillReceivedRepositoryEloquent
 * @package namespace FinancialSystem\Repositories;
 */
class BillReceivedRepositoryEloquent extends BaseRepository implements BillReceivedRepository
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
        return BillReceived::class;
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
        return BillReceivedPresenter::class;
    }
}
