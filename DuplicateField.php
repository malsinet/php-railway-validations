<?php

/**
 * DuplicateField class file
 *
 * @category   Validations
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet.com.ar>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */


namespace github\malsinet\Railway\Validations;


/**
 * DuplicateField class
 *
 * Throws an exception if the field value has a duplicate
 *
 * @category   Validations
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet.com.ar>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
final class DuplicateField implements Contracts\Valid
{
    /**
     * Previous link in the validation chain
     *
     * @var Contracts\Valid
     */
    private $origin;

    /**
     * Required field name
     *
     * @var string
     */
    private $field;
    
    /**
     * Unique search object
     *
     * @var Contracts\Find
     */
    private $collection;

    /**
     * Request object
     *
     * @var Contracts\Request
     */
    public $req;
   
    /**
     * Class constructor
     *
     * @param Contracts\Valid $origin Previous link in the validation chain
     * @param string          $field  Required field name 
     * @param Contracts\Find  $items  Collection to be searched for duplicates
     */
    public function __construct($origin, $checkField, $idField, $items)
    {
        $this->origin = $origin;
        $this->field = $field;
        $this->items = $items;
        $this->req = $origin->req;
    }
    
    /**
     * Checks if the request field is unique
     * and executes the next validation in the chain
     *
     * @return bool
     */
    public function validate()
    {
        $id = $this->req->get($this->idField);
        $value = $this->req->get($this->checkField);
        foreach ($this->items->find($value) as $row) {
            if ($row[$idField] !== $id) {
                throw new ValidationException("Field {$this->field} [$value] already exists");
            }
        }
        return $this->origin->validate();
    }


}