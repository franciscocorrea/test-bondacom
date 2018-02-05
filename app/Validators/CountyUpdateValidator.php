<?php 

namespace App\Validators;

class CountyUpdateValidator extends Validator
{
    /**
     * Set Rules Validation
     */
    public static $rules = array(
        'name'     => 'required|string',
    );
}