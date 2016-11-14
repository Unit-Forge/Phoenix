<?php

namespace Phoenix\Models\Unit\Group;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 * @package Phoenix\Models\Unit\Group
 */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function positions()
    {
        return $this->hasMany('Phoenix\Models\Unit\Group\Position');
    }

}
