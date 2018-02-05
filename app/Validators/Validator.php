<?php 

namespace App\Validators;

abstract class Validator {
    /**
     * string 
     */
    protected $input;
    /**
     * string
     */
    public $messages;
    /**
     * array
     */
    public static $rules;

    /**
     * @param string input
     */
    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Get fails in validator.
     */
    public function fails()
    {
        $validation = \Validator::make($this->input, static::$rules);

        if ($validation->fails())
        {
            $this->messages = $validation->messages();
            return true;
        }

        return false;
    }

    /**
     * Get Messages.
     */
    public function messages()
    {
        return $this->messages;
    }
}