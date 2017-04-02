<?php

namespace FinancialSystem\Models;

use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CategoryExpense extends Model implements Transformable
{
    use TransformableTrait;
    use BelongsToTenants;
    use NodeTrait;

    protected $fillable = ['name'];

    public static $enableTenant = true;

    public function newQuery()
    {
        $builder = $this->newQueryWithoutScopes();

        foreach ($this->getGlobalScopes() as $identifier => $scope) {

            if((static::$enableTenant && $identifier == 'client_id') || $identifier != 'client_id') {

                $builder->withGlobalScope($identifier, $scope);

            }

        }

        return $builder;
    }

}
