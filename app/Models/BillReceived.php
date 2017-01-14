<?php

namespace FinancialSystem\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class BillReceived extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['date_due', 'name', 'value', 'done'];

    protected $dates = ['date_due'];

}
