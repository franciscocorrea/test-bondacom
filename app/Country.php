<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * @var string
     */
    protected $table = 'countries';

    /**
     * @var array
     */
    protected $fillable = ['name', 'acronym'];

    /**
     * Get the states for the country.
     */
    public function states()
    {
        return $this->hasMany('App\State');
    }
}
