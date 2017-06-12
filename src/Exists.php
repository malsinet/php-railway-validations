<?php

/**
 * Exists class file
 *
 * @category   Validations
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */


namespace github\malsinet\Railway\Validations;


/**
 * RequiredField class
 *
 * Throws an exception if the entered value 
 * does not exist in the collection
 *
 * @category   Validations
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
final class Exists implements Contracts\Valid
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
    public function __construct($origin, $field, $items)
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
        $value = $this->req->get($this->field);
        if (!$this->items->find($value)) {
            throw new ValidationException(
                "Field {$this->field} [$value] does not exist"
            );
        }
        return $this->origin->validate();
    }


}