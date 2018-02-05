<?php 

namespace App\Validators;

class StateValidator extends Validator
{
    /**
     * 
     */
    public static $rules = array(
        'name'     => 'required|string',
        'acronym_country'   => 'required',
    );
}