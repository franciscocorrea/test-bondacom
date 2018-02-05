<?php 

namespace App\Validators;

class StateValidator extends Validator
{
    /**
     * Set Rules Validation
     */
    public static $rules = array(
        'name'     => 'required|string',
        'acronym_country'   => 'required',
    );
}