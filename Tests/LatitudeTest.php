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
 * Test should throw an exception if the required $field is not a valid latitude
 *
 * @category   Tests
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet.com.ar>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
class LatitudeTest extends TestCase
{

	public function testEmptyFieldThrowsException()
	{
        $field = new Validations\Latitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array())
            ),
            "lat"
        );
        $this->expectException(Validations\ValidationException::class);
        $field->validate();
    }

	public function testInvalidLatitudeThrowsException()
	{
        $field = new Validations\Latitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("lat" => "3ld2.."))
            ),
            "lat"
        );
        $this->expectException(Validations\ValidationException::class);
        $field->validate();
    }

 	public function testLowerThanMinusNinetyLatitudeThrowsException()
	{
        $field = new Validations\Latitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("lat" => "-112"))
            ),
            "lat"
        );
        $this->expectException(Validations\ValidationException::class);
        $field->validate();
    }

 	public function testHigherThanNinetyLatitudeThrowsException()
	{
        $field = new Validations\Latitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("lat" => "95"))
            ),
            "lat"
        );
        $this->expectException(Validations\ValidationException::class);
        $field->validate();
    }

	public function testValidFieldReturnsTrue()
	{
        $field = new Validations\Latitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("lat" => "30"))
            ),
            "lat"
        );
        $this->assertTrue($field->validate(), "Valid latitude should return true");
    }

 	public function testMinLatitudeReturnsTrue()
	{
        $field = new Validations\Latitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("lat" => "-90"))
            ),
            "lat"
        );
        $this->assertTrue($field->validate(), "Valid latitude should return true");
    }

 	public function testZeroLatitudeReturnsTrue()
	{
        $field = new Validations\Latitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("lat" => "0"))
            ),
            "lat"
        );
        $this->assertTrue($field->validate(), "Valid latitude should return true");
    }

	public function testMaxLatitudeReturnsTrue()
	{
        $field = new Validations\Latitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("lat" => "90"))
            ),
            "lat"
        );
        $this->assertTrue($field->validate(), "Valid latitude should return true");
    }

	public function testFloatLatitudeReturnsTrue()
	{
        $field = new Validations\Latitude(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("lat" => "34.443"))
            ),
            "lat"
        );
        $this->assertTrue($field->validate(), "Valid latitude should return true");
    }

}