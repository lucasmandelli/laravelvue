<?php

namespace FinancialSystem\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use FinancialSystem\Repositories\ClientRepository;
use FinancialSystem\Models\Client;
use FinancialSystem\Validators\ClientValidator;

/**
 * Class ClientRepositoryEloquent
 * @package namespace FinancialSystem\Repositories;
 */
class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Client::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
