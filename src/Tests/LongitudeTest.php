<?php

/**
 * RequiredFieldTest file
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
 * RequiredFieldTest class
 *
 * Test should throw an exception if the required $field is not a valid longitude
 *
 * @category   Tests
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet.com.ar>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
class LongitudeTest extends TestCase
{

	public function testEmptyFieldThrowsException()
	{
        $field = new Validations\Longitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array())
            ),
            "long"
        );
        $this->expectException(Validations\ValidationException::class);
        $field->validate();
    }

	public function testInvalidLongitudeThrowsException()
	{
        $field = new Validations\Longitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("long" => "3ld2.."))
            ),
            "long"
        );
        $this->expectException(Validations\ValidationException::class);
        $field->validate();
    }

 	public function testLongitudeTooLowThrowsException()
	{
        $field = new Validations\Longitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("long" => "-412"))
            ),
            "long"
        );
        $this->expectException(Validations\ValidationException::class);
        $field->validate();
    }

 	public function testLongitudeTooHighThrowsException()
	{
        $field = new Validations\Longitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("long" => "195"))
            ),
            "long"
        );
        $this->expectException(Validations\ValidationException::class);
        $field->validate();
    }

	public function testValidFieldReturnsTrue()
	{
        $field = new Validations\Longitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("long" => "30"))
            ),
            "long"
        );
        $this->assertTrue($field->validate(), "Valid longitude should return true");
    }

	public function testMinLongitudeReturnsTrue()
	{
        $field = new Validations\Longitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("long" => "-180"))
            ),
            "long"
        );
        $this->assertTrue($field->validate(), "Valid longitude should return true");
    }

	public function testZeroLongitudeReturnsTrue()
	{
        $field = new Validations\Longitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("long" => "0"))
            ),
            "long"
        );
        $this->assertTrue($field->validate(), "Valid longitude should return true");
    }

	public function testMaxLongitudeReturnsTrue()
	{
        $field = new Validations\Longitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("long" => "180"))
            ),
            "long"
        );
        $this->assertTrue($field->validate(), "Valid longitude should return true");
    }

	public function testFloatLongitudeReturnsTrue()
	{
        $field = new Validations\Longitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("long" => "34.443"))
            ),
            "long"
        );
        $this->assertTrue($field->validate(), "Valid longitude should return true");
    }

}