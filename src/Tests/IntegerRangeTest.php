<?php

/**
 * IntegerRangeTest file
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
 * IntegerRangeTest class
 *
 * Test should throw an exception if the $field is not a positive integer
 *
 * @category   Tests
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
class IntegerRangeTest extends TestCase
{

	public function testEmptyValueThrowsException()
	{
        $field = new V\IntegerRange(
            new V\AlwaysValid(
                new V\DefaultRequest(array())
            ),
            $fld="number", $min=25, $max=89
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testLowerThanMinThrowsException()
	{
        $value = 13;
        $field = new V\IntegerRange(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            $fld="number", $min=25, $max=89
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testHigherThanMaxThrowsException()
	{
        $value = 133;
        $field = new V\IntegerRange(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            $fld="number", $min=25, $max=89
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testFloatStringThrowsException()
	{
        $value = "44.3";
        $field = new V\IntegerRange(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            $fld="number", $min=25, $max=89
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testFloatThrowsException()
	{
        $value = 44.3;
        $field = new V\IntegerRange(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            $fld="number", $min=25, $max=89
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testLettersThrowsException()
	{
        $value = "4ewewe222";
        $field = new V\IntegerRange(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            $fld="number", $min=25, $max=89
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

 	public function testMinValueReturnsTrue()
	{
        $value = 25;
        $field = new V\IntegerRange(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            $fld="number", $min=25, $max=89
        );
        $this->assertTrue(
            $field->validate(),
            "Validating the minimum value [$value] in ".
            "the range [$min - $max] should return true"
        );
    }

 	public function testMaxValueReturnsTrue()
	{
        $value = 89;
        $field = new V\IntegerRange(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            $fld="number", $min=25, $max=89
        );
        $this->assertTrue(
            $field->validate(),
            "Validating the maximum value [$value] in ".
            "the range [$min - $max] should return true"
        );
    }

 	public function testIntegerInsideRangeReturnsTrue()
	{
        $value = 40;
        $field = new V\IntegerRange(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            $fld="number", $min=25, $max=89
        );
        $this->assertTrue(
            $field->validate(),
            "Validating a number [$value] inside ".
            "the range [$min - $max] should return true"
        );
    }

	public function testIntegerStringInsideRangeReturnsTrue()
	{
        $value = "40";
        $field = new V\IntegerRange(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            $fld="number", $min=25, $max=89
        );
        $this->assertTrue(
            $field->validate(),
            "Validating a numeric string [$value] inside ".
            "the range [$min - $max] should return true"
        );
    }

 	public function testZeroInsideRangeReturnsTrue()
	{
        $value = 0;
        $field = new V\IntegerRange(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            $fld="number", $min=-10, $max=89
        );
        $this->assertTrue(
            $field->validate(),
            "Validating zero [$value] inside ".
            "the range [$min - $max] should return true"
        );
    }

 	public function testZeroAsMinValueReturnsTrue()
	{
        $value = 0;
        $field = new V\IntegerRange(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            $fld="number", $min=0, $max=89
        );
        $this->assertTrue(
            $field->validate(),
            "Validating zero [$value] as minimum of ".
            "the range [$min - $max] should return true"
        );
    }

 	public function testZeroAsMaxValueReturnsTrue()
	{
        $value = 0;
        $field = new V\IntegerRange(
            new V\AlwaysValid(
                new V\DefaultRequest(array("number" => $value))
            ),
            $fld="number", $min=-300, $max=0
        );
        $this->assertTrue(
            $field->validate(),
            "Validating zero [$value] as maximum of ".
            "the range [$min - $max] should return true"
        );
    }

}