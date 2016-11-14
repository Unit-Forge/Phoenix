<?php

namespace Phoenix\Models\Unit\Group;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'order',
    ];

    public function positions()
    {
        return $this->hasMany('Phoenix\Models\Unit\Group\Position');
    }

}
