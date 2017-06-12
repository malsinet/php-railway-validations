<?php

/**
 * Date class file
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
 * Date class
 *
 * Throws an exception if the required $field is not a valid date
 *
 * @category   Validations
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
final class Date implements Contracts\Valid
{

    /**
     * Previous link in the validation chain
     *
     * @var Contracts\Valid
     */
    private $origin;

    /**
     * Date field name
     *
     * @var string
     */
    private $field;
    
    /**
     * Date format
     *
     * @var string
     */
    private $format;
    
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
    public function __construct(Contracts\Valid $origin, $field, $format)
    {
        $this->origin = $origin;
        $this->field = $field;
        $this->format = $format;
        $this->req = $origin->req;
    }

    /**
     * Checks if the request field is a valid date
     * and executes the next validation in the chain
     *
     * @return bool
     */
    public function validate()
    {
        $date = $this->req->get($this->field);
        if (false === strtotime($date)) {
            throw new ValidationException(
                "Field {$this->field} [{$date}] must be a valid date"
            );
        }
        if ($date != date($this->format, strtotime($date))) {
            throw new ValidationException(
                "Field {$this->field} [{$date}] ".
                "does not match date format [{$this->format}]"
            );
        }
        return $this->origin->validate();
    }

}