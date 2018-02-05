<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * @var string
     */
    protected $table = 'cities';

    /**
     * @var array
     */
    protected $fillable = ['name', 'zip_code', 'state_id', 'county_id'];

    /**
     * Get the state.
     */
    public function state()
    {
        return $this->belongsTo('App\State');
    }

    /**
     * Get the country.
     */
    public function county()
    {
        return $this->belongsTo('App\County');
    }
}
