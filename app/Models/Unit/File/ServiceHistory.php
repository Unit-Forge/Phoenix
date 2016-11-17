<?php

namespace Phoenix\Models\Unit\File;

use Illuminate\Database\Eloquent\Model;

class ServiceHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'message', 'link',
    ];

    public function file()
    {
        return $this->belongsTo('Phoenix\Models\Unit\File\File');
    }

}
