<?php

/**
 * PositiveIntegerTest file
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
use github\malsinet\Railway\Validations as V;


/**
 * PositiveIntegerTest class
 *
 * Test should throw an exception if the $field is not a positive integer
 *
 * @category   Tests
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet.com.ar>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
class PositiveIntegerTest extends TestCase
{

	public function testEmptyValueThrowsException()
	{
        $field = new V\PositiveInteger(
            new V\AlwaysValid(
                new V\DefaultRequest(array())
            ),
            "number"
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testNegativeIntegerThrowsException()
	{
        $value = -33;
        $field = new V\PositiveInteger(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            "number"
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testNegativeStringThrowsException()
	{
        $value = "-44";
        $field = new V\PositiveInteger(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            "number"
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testNegativeFloatStringThrowsException()
	{
        $value = "-4.3";
        $field = new V\PositiveInteger(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            "number"
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testNegativeFloatThrowsException()
	{
        $value = -4.3;
        $field = new V\PositiveInteger(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            "number"
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testLettersThrowsException()
	{
        $value = "4.ewewe222";
        $field = new V\PositiveInteger(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            "number"
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

 	public function testValidIntegerReturnsTrue()
	{
        $value = 400;
        $field = new V\PositiveInteger(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            "number"
        );
        $this->assertTrue(
            $field->validate(),
            "Validating a positive number [$value] should return true"
        );
    }

	public function testValidStringReturnsTrue()
	{
        $value = "400";
        $field = new V\PositiveInteger(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            "number"
        );
        $this->assertTrue(
            $field->validate(),
            "Validating a positive number [$value] should return true"
        );
    }

}