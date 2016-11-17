<?php

namespace Phoenix\Models\Unit\File;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Award
 * @package Phoenix\Models\Unit\File
 */
class Award extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'details', 'link',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany('Phoenix\Models\Unit\File\File');
    }
}
