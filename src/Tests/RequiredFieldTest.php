<?php

/**
 * RequiredFieldTest file
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
use github\malsinet\Railway\Validations;


/**
 * RequiredFieldTest class
 *
 * Test should throw an exception if the required $field is empty
 *
 * @category   Tests
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
class RequiredFieldTest extends TestCase
{

	public function testEmptyFieldThrowsException()
	{
        $field = new Validations\RequiredField(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array())
            ),
            "name"
        );
        $this->expectException(Validations\ValidationException::class);
        $field->validate();
    }

	public function testValidFieldReturnsTrue()
	{
        $field = new Validations\RequiredField(
            new Validations\AlwaysValid(
                new Validations\DefaultRequest(array("name" => "Charles"))
            ),
            "name"
        );
        $this->assertTrue($field->validate(), "Valid request should return true");
    }

}