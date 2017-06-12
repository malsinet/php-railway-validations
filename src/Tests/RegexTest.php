<?php

/**
 * RegexTest file
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
class RegexTest extends TestCase
{

	public function testEmptyFieldThrowsException()
	{
        $field = new V\Regex(
            new V\AlwaysValid(
                new V\DefaultRequest(array())
            ),
            $field=null, $regex="/[a-z]/"
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

 	public function testEmptyRegexThrowsException()
	{
        $field = new V\Regex(
            new V\AlwaysValid(
                new V\DefaultRequest(
                    array("email" => "")
                )
            ),
            "email", $regex=null
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

 	public function testInvalidRegexThrowsException()
	{
        $field = new V\Regex(
            new V\AlwaysValid(
                new V\DefaultRequest(
                    array("email" => "user@domail.com")
                )
            ),
            "email", $regex="/"
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testInvalidMatchThrowsException()
	{
        $field = new V\Regex(
            new V\AlwaysValid(
                new V\DefaultRequest(array("email" => "user@"))
            ),
            "email", $regex="/[a-z]+@[a-z]+\.com/"
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

 	public function testEmptyValueThrowsException()
	{
        $field = new V\Regex(
            new V\AlwaysValid(
                new V\DefaultRequest(
                    array("email" => "")
                )
            ),
            "email", $regex="/[a-z]/"
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

 	public function testValidMatchReturnsTrue()
	{
        $field = new V\Regex(
            new V\AlwaysValid(
                new V\DefaultRequest(
                    array("email" => "billg@microsoft.com")
                )
            ),
            "email", $regex="/[a-z]+@[a-z]+\.com/"
        );
        $this->assertTrue(
            $field->validate(),
            "Valid match should return true"
        );
    }


}