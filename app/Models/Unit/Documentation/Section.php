<?php

namespace Phoenix\Models\Unit\Documentation;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
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
    public function pages()
    {
        return $this->hasMany('Phoenix\Models\Unit\Documentation\Page');
    }

    public function category()
    {
        return $this->belongsTo('Phoenix\Models\Unit\Documentation\Category');
    }

}
