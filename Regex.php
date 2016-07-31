<?php

/**
 * Regex class file
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
 * Regex class
 *
 * Throws an exception if the required $field is not a latitude
 *
 * @category   Validations
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet.com.ar>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
final class Regex implements Contracts\Valid
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
     * Regex
     *
     * @var string
     */
    private $regex;
    
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
    public function __construct(Contracts\Valid $origin, $field, $regex)
    {
        $this->origin = $origin;
        $this->field = $field;
        $this->regex = $regex;
        $this->req = $origin->req;
    }

    /**
     * Checks if the request field matches the regular expression
     * and executes the next validation in the chain
     *
     * @return bool
     */
    public function validate()
    {
        $value = $this->req->get($this->field);
        if (empty($this->regex)) {
            throw new ValidationException("Regex cannot be empty");
        }
        $old_error = error_reporting(0);
        $match = preg_match($this->regex, $value);
        if ($match === false) {
            $error = error_get_last();
            throw new ValidationException(
                "Regex [$this->regex] failed with error: $error"
            );
        }
        error_reporting($old_error);
        if (!preg_match($this->regex, $value)) {
            throw new ValidationException(
                "Field {$this->field} [{$value}] does not match [regex:{$this->regex}]"
            );
        }
        return $this->origin->validate();
    }

}