<?php

namespace VAT\Routes\Validations;

use VAT\Contracts\Valid;

final class ValidLongitude implements Valid
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
        $longitude = $this->req->get($this->field);
        if (!is_numeric($longitude) ||
            (is_string($longitude) && !preg_match("/^\-?[0-9][0-9]?[0-9]?(\.[0-9]+)?$/", $longitude)) ||
            (is_numeric($longitude) && (180  < $longitude)) ||
            (is_numeric($longitude) && (-180 > $longitude))
        ) {
            throw new ValidationException("Field [{$this->field}={$longitude}] must be a valid longitude (-180 to +180)");
        }

        return $this->origin->validate();
    }

    public function toRow()
    {
        return $this->origin->toRow();
    }
    
}