<?php

namespace Phoenix\Models\User;

use Illuminate\Database\Eloquent\Model;

class Teamspeak extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'description'
    ];

    public function user()
    {
        return $this->belongsTo('Phoenix\Models\User');
    }
}
