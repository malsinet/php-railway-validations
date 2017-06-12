<?php

/**
 * DateTest file
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
 * DateTest class
 *
 * Test should throw an exception 
 * if the required $field is not a valid date
 *
 * @category   Tests
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
class DateTest extends TestCase
{

	public function testEmptyFieldThrowsException()
	{
        $field = new V\Date(
            new V\AlwaysValid(
                new V\DefaultRequest(array())
            ),
            $field=null, $format="Y-m-d"
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testInvalidDateThrowsException()
	{
        $field = new V\Date(
            new V\AlwaysValid(
                new V\DefaultRequest(array("date" => "20111-43-12"))
            ),
            $field="date", $format="Y-m-d"
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testInvalidFormatThrowsException()
	{
        $field = new V\Date(
            new V\AlwaysValid(
                new V\DefaultRequest(array("date" => "2011-02-12"))
            ),
            $field="date", $format="Y-m-d H:i:s"
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

 	public function testEmptyDateThrowsException()
	{
        $field = new V\Date(
            new V\AlwaysValid(
                new V\DefaultRequest(
                    array("date" => "")
                )
            ),
            $field="date", $format="Y-m-d"
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

 	public function testValidDate()
	{
        $field = new V\Date(
            new V\AlwaysValid(
                new V\DefaultRequest(
                    array("date" => "2016-08-10")
                )
            ),
            $field="date", $format="Y-m-d" 
        );
        $this->assertTrue(
            $field->validate(),
            "Valid date should return true"
        );
    }

}