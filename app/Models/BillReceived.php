<?php

namespace FinancialSystem\Models;

use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class BillReceived extends Model implements Transformable
{
    use TransformableTrait;
    use BelongsToTenants;

    protected $table = 'bills_received';

    protected $fillable = ['date_due', 'name', 'value', 'done'];

    protected $dates = ['date_due'];

}
