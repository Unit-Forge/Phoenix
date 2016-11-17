<?php

namespace Phoenix\Models\Unit\File;

use Illuminate\Database\Eloquent\Model;

/**
 * Class File
 * @package Phoenix\Models\Unit\File
 */
class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status', 'searchable_name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Phoenix/Models/User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function awards()
    {
        return $this->belongsToMany('Phoenix\Models\Unit\File\Award')->withPivot('reason','date_awarded');
    }

    public function serviceHistory()
    {
        return $this->hasMany('Phoenix\Models\Unit\File\ServiceHistory');
    }

}
