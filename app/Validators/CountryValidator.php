<?php 

namespace App\Validators;

class CountryValidator extends Validator
{
    /**
     * 
     */
    public static $rules = array(
        'name'     => 'required|string',
        'acronym'    => 'required|string',
    );
}