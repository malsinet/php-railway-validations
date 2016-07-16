<?php

namespace VAT\Routes\Validations;

use VAT\Contracts\Valid;

final class ValidLatitude implements Valid
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
        $latitude = $this->req->get($this->field);
        if (!is_numeric($latitude) ||
            (is_string($latitude) && !preg_match("/^[0-9][0-9]?(\.[0-9]+)?$/", $latitude)) ||
            (is_numeric($latitude) && (90 < $latitude)) ||
            (is_numeric($latitude) && (0  > $latitude))
        ) {
            throw new ValidationException("Field [{$this->field}={$latitude}] must be a valid latitude (0-90)");
        }
                      
        return $this->origin->validate();
    }

    public function toRow()
    {
        return $this->origin->toRow();
    }
    
}