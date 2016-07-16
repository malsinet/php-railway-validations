<?php

namespace VAT\Routes\Validations;

use VAT\Contracts\Valid;

final class RequiredField implements Valid
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
        if (empty($this->req->get($field))) {
            throw new ValidationException("Field [{$this->field}] is required");
        }
        return $this->origin->validate();
    }

    public function toRow()
    {
        return $this->origin->toRow();
    }
    
}