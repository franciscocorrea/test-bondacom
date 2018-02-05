<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    /**
     * @var string
     */
    protected $table = 'counties';

    /**
     * @var array
     */
    protected $fillable = ['name', 'state_id'];


    /**
     * Get the post that owns the state.
     */
    public function state()
    {
        return $this->belongsTo('App\State');
    }

    /**
     * Get the cities for the county.
     */
    public function cities()
    {
        return $this->hasMany('App\City');
    }


}
