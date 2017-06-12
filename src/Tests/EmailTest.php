<?php

/**
 * EmailTest file
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
 * RequiredFieldTest class
 *
 * Test should throw an exception if the required $field is not a valid email
 *
 * @category   Tests
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
class EmailTest extends TestCase
{

	public function testEmptyFieldThrowsException()
	{
        $field = new V\Email(
            new V\AlwaysValid(
                new V\DefaultRequest(array())
            ),
            $field=null
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testInvalidLatitudeThrowsException()
	{
        $field = new V\Email(
            new V\AlwaysValid(
                new V\DefaultRequest(array("email" => "user@"))
            ),
            "email"
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

 	public function testEmptyEmailThrowsException()
	{
        $field = new V\Email(
            new V\AlwaysValid(
                new V\DefaultRequest(
                    array("email" => "")
                )
            ),
            "email"
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

 	public function testValidEmail()
	{
        $field = new V\Email(
            new V\AlwaysValid(
                new V\DefaultRequest(
                    array("email" => "billg@microsoft.com")
                )
            ),
            "email"
        );
        $this->assertTrue(
            $field->validate(),
            "Valid email should return true"
        );
    }


}