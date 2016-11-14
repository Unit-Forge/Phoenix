<?php

namespace Phoenix\Models\Unit;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'pay_grade', 'abbreviation',
    ];

}
