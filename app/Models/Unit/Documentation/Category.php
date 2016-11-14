<?php

namespace Phoenix\Models\Unit\Documentation;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package Phoenix\Models\Unit\Documentation
 */
class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'icon', 'order',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections()
    {
        return $this->hasMany('Phoenix\Models\Unit\Documentation\Section','category_id','id');
    }

}
