<?php

/**
 * DefaultRequest class file
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
 * DefaultRequest class
 *
 * Basic Request class 
 *
 * @category   Validations
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet.com.ar>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
final class DefaultRequest implements Contracts\Request
{
    
    /**
     * Request parameters
     *
     * @var array
     */
    private $params;
    
    /**
     * Class constructor
     *
     * @param array $params Request parameters
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * Returns a request parameter value
     *
     * @return mixed
     */
    public function get($name)
    {
        $value = null;
        if (!empty($this->params[$name])) {
            $value = $this->params[$name];
        }
        return $value;
    }

}