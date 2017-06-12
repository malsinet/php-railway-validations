<?php

/**
 * ValidationArrayTest file
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
 * ValidationArrayTest class
 *
 * Test should throw an exception if any of the validations in the array fails
 *
 * @category   Tests
 * @package    Railway Validations
 * @author     Martin Alsinet <martin@alsinet>
 * @copyright  2016 @MartinAlsinet
 * @license    MIT License
 * @version    Release: 0.1.0
 * @link       http://github.com/malsinet/railway-validations
 */
class ValidationArrayTest extends TestCase
{

	public function testNotArrayThrowsException()
	{
        $field = new V\ValidationArray(
            new V\AlwaysValid(
                new V\DefaultRequest(array("name" => "Rita"))
            ),
            $validations="this is not an array"
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testEmptyArrayThrowsException()
	{
        $field = new V\ValidationArray(
            new V\AlwaysValid(
                new V\DefaultRequest(array("name" => "Rita"))
            ),
            $validations=array()
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testOneInvalidItemThrowsException()
	{
        $req = array(
            "name" => "Capitals",
            "places" => array(
                array("name" => "Buenos Aires", "latitude" => "12.32", "longitude" => "-88.54"),
                array("name" => "Santiago", "latitude" => "12.32", "longitude" => "-88.54"),
                array("name" => "San Pablo", "latitude" => "12.32", "longitude" => "-88.54"),
                array("name" => "", "latitude" => "12.32", "longitude" => "-88.54"),
                array("name" => "Bogota", "latitude" => "12.32", "longitude" => "-88.54")
            )
        );
        $validations = array();
        foreach ($req["places"] as $item) {
            $validations[] = new V\Longitude(
                new V\RequiredField(
                    new V\Latitude(
                        new V\RequiredField(
                            new V\RequiredField(
                                new V\AlwaysValid(
                                    new V\DefaultRequest($item)
                                ), "name"
                            ), "latitude"
                        ), "latitude"
                    ), "longitude"
                ), "longitude"
            );
        }
        $field = new V\ValidationArray(
            new V\AlwaysValid(
                new V\DefaultRequest($req)
            ), $validations
        );
        $this->expectException(V\ValidationException::class);
        $field->validate();
    }

	public function testValidArrayReturnsTrue()
	{
        $req = array(
            "name" => "Capitals",
            "places" => array(
                array("name" => "Buenos Aires", "latitude" => "12.32", "longitude" => "-88.54"),
                array("name" => "Santiago", "latitude" => "12.32", "longitude" => "-88.54"),
                array("name" => "San Pablo", "latitude" => "12.32", "longitude" => "-88.54")
            )
        );
        $validations = array();
        foreach ($req["places"] as $item) {
            $validations[] = new V\Longitude(
                new V\RequiredField(
                    new V\Latitude(
                        new V\RequiredField(
                            new V\RequiredField(
                                new V\AlwaysValid(
                                    new V\DefaultRequest($item)
                                ), "name"
                            ), "latitude"
                        ), "latitude"
                    ), "longitude"
                ), "longitude"
            );
        }
        $field = new V\ValidationArray(
            new V\AlwaysValid(
                new V\DefaultRequest($req)
            ), $validations
        );
        $this->assertTrue($field->validate(), "Valid array should return true");
    }
}