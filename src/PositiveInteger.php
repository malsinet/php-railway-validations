<?php

/**
 * RequiredField class file
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
 * Throws an exception if the required $field is empty
 *
 * @category   Validations
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
final class PositiveInteger implements Contracts\Valid
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
     * Request object
     *
     * @var Contracts\Request
     */
    public $req;
   
    /**
     * Class constructor
     *
     * @param Contracts\Valid  $origin Previous link in the validation chain
     * @param string           $field  Required field name
     */
    public function __construct(Contracts\Valid $origin, $field)
    {
        $this->origin = $origin;
        $this->field = $field;
        $this->req = $origin->req;
    }

    /**
     * Checks if the request field is a positive integer 
     * and executes the next validation in the chain
     *
     * @return bool
     */
    public function validate()
    {
        $number = $this->req->get($this->field);
        if (!filter_var(
            $number,
            FILTER_VALIDATE_INT,
            array("options" => array("min_range" => 1)))
        ){
            throw new ValidationException(
                "Field {$this->field} [{$number}] must be a positive Integer"
            );
        }

        return $this->origin->validate();
    }

}