<?php

/**
 * ValidationArray class file
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
 * ValidationArray class
 *
 * Throws an exception if any the validation array items is not valid
 *
 * @category   Validations
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet.com.ar>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
final class ValidationArray implements Contracts\Valid
{
    /**
     * Previous link in the validation chain
     *
     * @var Contracts\Valid
     */
    private $origin;

    /**
     * Validation Array
     *
     * @var array
     */
    private $validations;
    
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
     * @param array            $items  Validations array
     */
    public function __construct(Contracts\Valid $origin, $validations)
    {
        $this->origin = $origin;
        $this->req = $origin->req;
        $this->validations = $validations;
     }

    /**
     * Checks if the validations array items are valid
     * and executes the next validation in the chain
     *
     * @return bool
     */
    public function validate()
    {
        if (!is_array($this->validations)) {
            throw new ValidationException("Field [validations] must be an array");
        }
        foreach ($this->validations as $item) {
            $item->validate();
        }

        return $this->origin->validate();
    }

}