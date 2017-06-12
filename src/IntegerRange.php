<?php

/**
 * IntegerRange class file
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
 * IntegerRange class
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
final class IntegerRange implements Contracts\Valid
{

    /**
     * Previous link in the validation chain
     *
     * @var Contracts\Valid
     */
    private $origin;

    /**
     * Value field name
     *
     * @var string
     */
    private $field;
    
    /**
     * Minimum value
     *
     * @var integer
     */
    private $min;
    
    /**
     * Maximum value
     *
     * @var integer
     */
    private $max;
    
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
    public function __construct(Contracts\Valid $origin, $field, $min, $max)
    {
        $this->origin = $origin;
        $this->field = $field;
        $this->min = $min;
        $this->max = $max;
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
        if (false === filter_var(
            $number,
            FILTER_VALIDATE_INT,
            array("options" => array(
                "min_range" => $this->min,
                "max_range" => $this->max
            ))
        )){
            throw new ValidationException(
                "Field {$this->field} [{$number}] must be ".
                "an integer between [{$this->min}] and [{$this->max}]"
            );
        }
        return $this->origin->validate();
    }

}