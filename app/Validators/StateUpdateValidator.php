<?php 

namespace App\Validators;

class StateUpdateValidator extends Validator
{
    /**
     * 
     */
    public static $rules = array(
        'name'     => 'required|string',
    );
}