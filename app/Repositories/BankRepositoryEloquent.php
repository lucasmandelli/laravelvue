<?php

namespace FinancialSystem\Repositories;

use FinancialSystem\Events\BankStoredEvent;
use FinancialSystem\Presenters\BankPresenter;
use Illuminate\Http\UploadedFile;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use FinancialSystem\Models\Bank;

/**
 * Class BankRepositoryEloquent
 * @package namespace FinancialSystem\Repositories;
 */
class BankRepositoryEloquent extends BaseRepository implements BankRepository
{

    protected $fieldSearchable = [
        'name' => 'like',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Bank::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Override from create to prevent error when it was trying to store a new bank.
     * The attriibutes property receives logo with a UploadedFile instance.
     *
     * @param array $attributes
     * @return Bank
     */
    public function create(array $attributes)
    {
        $logo = $attributes['logo'];
        $attributes['logo'] = env('IMAGE_DEFAULT');

        $skipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $bank = parent::create($attributes);

        $event = new BankStoredEvent($bank, $logo);
        event($event);

        $this->skipPresenter = $skipPresenter;

        return $this->parserResult(bank);
    }

    public function update(array $attributes, $id)
    {
        $logo = null;
        if(isset($attributes['logo']) && $attributes['logo'] instanceof UploadedFile) {
            $logo = $attributes['logo'];
            unset($attributes['logo']);
        }

        $skipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $bank = parent::update($attributes, $id);

        $event = new BankStoredEvent($bank, $logo);
        event($event);

        $this->skipPresenter = $skipPresenter;

        return $this->parserResult(bank);
    }

    public function delete($id)
    {

        $bank = Bank::find($id);

        if($bank->logo != env('IMAGE_DEFAULT')) {
            \Storage::disk('public')->delete(Bank::logosDir().'/'.$bank->logo);
        }

        return parent::delete($id);
    }

    /**
     * @return mixed
     */
    public function presenter()
    {
        return BankPresenter::class;
    }

}
