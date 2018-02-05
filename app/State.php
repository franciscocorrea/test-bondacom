<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
     * @var string
     */
    protected $table = 'states';

    /**
     * @var array
     */
    protected $fillable = ['name', 'country_id'];

    /**
     * Get the country.
     */
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    /**
     * Get the counties for the state.
     */
    public function counties()
    {
        return $this->hasMany('App\County');
    }

    /**
     * Get the cities for the state.
     */
    public function cities()
    {
        return $this->hasMany('App\City');
    }

}
