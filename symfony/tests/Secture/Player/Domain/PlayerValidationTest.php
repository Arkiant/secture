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
}
