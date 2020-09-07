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
        $validator = new PlayerValidation();
        $validator->validate([]);
    }

    public function testEmptyArgumentExceptionValidate()
    {
        $this->expectException(EmptyArgumentException::class);
        $validator = new PlayerValidation();
        $validator->validate(["name" => "", "price" => "", "position" => "", "team" => "team"]);
    }

    public function testPositionNotFoundExceptionValidate()
    {
        $this->expectException(PositionNotFoundException::class);
        $validator = new PlayerValidation();
        $validator->validate(["name" => "Test player", "price" => 100, "position" => "notfoundposition", "team" => 4]);
    }

    public function testSuccessfulValidation()
    {
        $validator = new PlayerValidation();
        $validator->validate(["name" => "Test player", "price" => 100, "position" => "goalkeeper", "team" => 4]);
        $this->assertTrue(true);
    }
}
