<?php 

namespace App\Validators;

class CityUpdateValidator extends Validator
{
    /**
     * Set Rules Validation
     */
    public static $rules = array(
        'name'     => 'required|string'
    );
}