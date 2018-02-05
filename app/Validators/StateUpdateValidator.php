<?php 

namespace App\Validators;

class StateUpdateValidator extends Validator
{
    /**
     * Set Rules Validation
     */
    public static $rules = array(
        'name'     => 'required|string',
    );
}