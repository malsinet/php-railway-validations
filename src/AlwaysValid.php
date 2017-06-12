<?php

/**
 * AlwaysValid class file
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

use github\malsinet\Railway\Validations\Contracts\Valid;


/**
 * AlwaysValid class
 *
 * This validation always return true
 *
 * @category   Validations
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
final class AlwaysValid implements Valid
{
    /**
     * Request object
     *
     * @var Request
     */
    public $req;

    /**
     * Class constructor
     *
     * @param mixed $request Request to be validated
     */
    public function __construct($request)
    {
        $this->req = $request;
    }

    /**
     * Always returns true
     *
     * @return bool
     */
    public function validate()
    {
        return true;
    }

}