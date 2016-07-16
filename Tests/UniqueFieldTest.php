<?php

/**
 * UniqueFieldTest file
 *
 * @category   Tests
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet.com.ar>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */


namespace github\malsinet\Railway\Validations\Tests;

use PHPUnit\Framework\TestCase;
use github\malsinet\Railway\Validations;


/**
 * UniqueFieldTest class
 *
 * Test should throw an exception if the required $field is not unique
 *
 * @category   Tests
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet.com.ar>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
class UniqueFieldTest extends TestCase
{

	public function testDuplicatedFieldThrowsException()
	{
        $field = new Validations\UniqueField(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("name" => "Paul"))
            ),
            "name",
            new Beatles(array("John", "Paul", "George", "Ringo"))
        );
        $this->expectException(Validations\ValidationException::class);
        $field->validate();
    }

	public function testUniqueFieldReturnsTrue()
	{
        $field = new Validations\UniqueField(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("name" => "Keith"))
            ),
            "name",
            new Beatles(array("John", "Paul", "George", "Ringo"))
        );
        $this->assertTrue($field->validate(), "Unique field should return true");
    }

}


class Beatles implements Validations\Contracts\Find
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