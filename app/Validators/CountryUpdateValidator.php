<?php 

namespace App\Validators;

class CountryUpdateValidator extends Validator
{
    /**
     * Set Rules Validation
     */
    public static $rules = array(
        'name'     => 'required|string',
        'acronym'    => 'string',
    );
}