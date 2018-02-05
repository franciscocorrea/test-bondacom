<?php 

namespace App\Validators;

class CityValidator extends Validator
{
    /**
     * Set Rules Validation
     */
    public static $rules = array(
        'name'     => 'required|string'
    );
}