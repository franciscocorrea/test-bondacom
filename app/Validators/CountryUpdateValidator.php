<?php 

namespace App\Validators;

class CountryUpdateValidator extends Validator
{
    /**
     * 
     */
    public static $rules = array(
        'name'     => 'required|string',
        'acronym'    => 'string',
    );
}