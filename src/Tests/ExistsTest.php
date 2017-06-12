<?php

/**
 * ExistsTest file
 *
 * @category   Tests
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */


namespace github\malsinet\Railway\Validations\Tests;

use PHPUnit\Framework\TestCase;
use github\malsinet\Railway\Validations as V;


/**
 * ExistsTest class
 *
 * Test should throw an exception if the required $field is not found
 *
 * @category   Tests
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
class ExistsTest extends TestCase
{

	public function testMissingValueThrowsException()
	{
        $field = new V\Exists(
            new V\AlwaysValid(
                new V\DefaultRequest(array("name" => "Keith"))
            ),
            "name",
            new TheBeatles(array("John", "Paul", "George", "Ringo"))
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testExistsReturnsTrue()
	{
        $field = new V\Exists(
            new V\AlwaysValid(
                new V\DefaultRequest(array("name" => "Paul"))
            ),
            "name",
            new TheBeatles(array("John", "Paul", "George", "Ringo"))
        );
        $this->assertTrue(
            $field->validate(),
            "Existing value should return true"
        );
    }

}


class TheBeatles implements V\Contracts\Find
{

    private $items;
    
    public function __construct($items)
    {
        $this->items = $items;
    }

    public function find($value)
    {
        return in_array($value, $this->items);
    }

}