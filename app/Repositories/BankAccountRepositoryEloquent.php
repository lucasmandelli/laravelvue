<?php

namespace FinancialSystem\Repositories;

use FinancialSystem\Presenters\BankAccountPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use FinancialSystem\Repositories\BankAccountRepository;
use FinancialSystem\Models\BankAccount;

/**
 * Class BankAccountRepositoryEloquent
 * @package namespace FinancialSystem\Repositories;
 */
class BankAccountRepositoryEloquent extends BaseRepository implements BankAccountRepository
{

    //protected $skipPresenter = true; If it dosen't need Presenter

    protected $fieldSearchable = [
        'name' => 'like',
        'agency' => 'like',
        'account' => 'like',
        'bank.name' => 'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BankAccount::class;
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
        return BankAccountPresenter::class;
    }


}
