<?php

/**
 * Latitude class file
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
 * Latitude class
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
final class Latitude implements Contracts\Valid
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
     * Checks if the request field is a latitude
     * and executes the next validation in the chain
     *
     * @return bool
     */
    public function validate()
    {
        $latitude = $this->req->get($this->field);

        $options = array(
            "options" => array(
                "min_range" => 0,
                "max_range" => 90
            )
        );
        
        if (!is_numeric($latitude) ||
            (is_string($latitude) && !preg_match("/^[0-9][0-9]?(\.[0-9]+)?$/", $latitude)) ||
            (is_numeric($latitude) && (90 < $latitude)) ||
            (is_numeric($latitude) && (0  > $latitude))
        ) {

            
            throw new ValidationException("Field [{$this->field}={$latitude}] must be a valid latitude (0-90)");
        }

        return $this->origin->validate();
    }

}