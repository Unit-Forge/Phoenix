<?php

namespace Phoenix\Models\Unit\Group;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'order', 'leader','primary'
    ];

    public function group()
    {
        return $this->belongsTo('Phoenix\Models\Unit\Group\Group');
    }
}
