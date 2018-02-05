<?php 

namespace App\Validators;

class CountryValidator extends Validator
{
    /**
     * Set Rules Validation
     */
    public static $rules = array(
        'name'     => 'required|string',
        'acronym'    => 'required|string',
    );
}