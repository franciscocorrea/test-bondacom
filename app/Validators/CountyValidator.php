<?php 

namespace App\Validators;

class CountyValidator extends Validator
{
    /**
     * Set Rules Validation
     */
    public static $rules = array(
        'name'     => 'required|string',
        'state_id'    => 'required',
    );
}