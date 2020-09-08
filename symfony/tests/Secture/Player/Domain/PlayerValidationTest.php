<?php

namespace App\Tests\Secture\Player\Domain;

use App\Secture\Player\Domain\Errors\EmptyArgumentException;
use App\Secture\Player\Domain\Errors\PositionNotFoundException;
use App\Secture\Player\Domain\Errors\PropertyNotExistsException;
use App\Secture\Player\Domain\PlayerValidation;
use PHPUnit\Framework\TestCase;

class PlayerValidationTest extends TestCase
{
    public function testPropertyNotExistsExceptionValidate()
    {
        $this->expectException(PropertyNotExistsException::class);
        PlayerValidation::validate([]);
    }

    public function testEmptyArgumentExceptionValidate()
    {
        $this->expectException(EmptyArgumentException::class);
        PlayerValidation::validate(["name" => "", "price" => "", "position" => "", "team" => "team"]);
    }

    public function testPositionNotFoundExceptionValidate()
    {
        $this->expectException(PositionNotFoundException::class);
        PlayerValidation::validate(["name" => "Test player", "price" => 100, "position" => "notfoundposition", "team" => 4]);
    }

    public function testSuccessfulValidation()
    {
        PlayerValidation::validate(["name" => "Test player", "price" => 100, "position" => "goalkeeper", "team" => 4]);
        $this->assertTrue(true);
    }

    public function testPropertyNotExistsValidateProperties()
    {
        $validateProperties = PlayerValidation::validateProperties([]);
        $this->assertFalse($validateProperties["result"]);
        $this->assertNotEmpty($validateProperties["values"]);
    }

    public function testPropertyValidateProperties()
    {
        $validateProperties = PlayerValidation::validateProperties(["name" => "", "price" => "", "position" => "", "team" => "team"]);
        $this->assertTrue($validateProperties["result"]);
        $this->assertEmpty($validateProperties["values"]);
    }

    public function testEmptyArgumentEmptyProperties()
    {
        $validateEmpty = PlayerValidation::validateEmptyProperties(["name" => "", "price" => "", "position" => "", "team" => "team"]);
        $this->assertFalse($validateEmpty["result"]);
        $this->assertNotEmpty($validateEmpty["values"]);
    }

    public function testEmptyProperties()
    {
        $validateEmpty = PlayerValidation::validateEmptyProperties(["name" => "test", "price" => 400, "position" => "goalkeeper", "team" => 5]);
        $this->assertTrue($validateEmpty["result"]);
        $this->assertEmpty($validateEmpty["values"]);
    }
}
