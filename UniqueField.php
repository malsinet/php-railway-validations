<?php

namespace VAT\Routes\Validations;

use VAT\Contracts\Valid;

final class UniqueName implements Valid
{

    private $origin;

    private $routes;
    
    public $req;

    public function __construct($origin, $routes)
    {
        $this->origin = $origin;
        $this->routes = $routes;
        $this->req    = $origin->req;
    }

    public function validate()
    {
        $name = $this->req->get("name");
        if (!empty($routes->findByName($name))) {
            throw new ValidationException("Route name [$name] already exists");
        }
        return $this->origin->validate();
    }

    public function toRow()
    {
        return $this->origin->toRow();
    }

}