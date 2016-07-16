<?php

namespace VAT\Routes\Validations;

use VAT\Contracts\Valid;

final class PositiveInteger implements Valid
{

    private $origin;

    private $field;
    
    public $req;

    public function __construct($origin, $field)
    {
        $this->origin = $origin;
        $this->field = $field;
        $this->req = $origin->req;
    }

    public function validate()
    {
        $number = $this->req->get($this->field);
        if (!is_int($number) ||
            (is_string($number) && !preg_match("/^[1-9][0-9]*$/", $number)) ||
            (is_int($number) && (1 > $number))
        ) {
            throw new ValidationException("Field [{$this->field}={$number}] must be a positive Integer");
        }
                      
        return $this->origin->validate();
    }

    public function toRow()
    {
        return $this->origin->toRow();
    }
    
}