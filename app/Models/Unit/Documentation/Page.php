<?php

namespace Phoenix\Models\Unit\Documentation;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'icon', 'order', 'content', 'published'
    ];


    public function section()
    {
        return $this->belongsTo('Phoenix\Models\Unit\Documentation\Section');
    }
}
