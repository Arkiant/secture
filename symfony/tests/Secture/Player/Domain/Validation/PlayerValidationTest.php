<?php

namespace App\Tests\Secture\Player\Domain;

use App\Secture\Player\Domain\Errors\EmptyArgumentException;
use App\Secture\Player\Domain\Errors\PositionNotFoundException;
use App\Secture\Player\Domain\Errors\PropertyNotExistsException;
use App\Secture\Player\Domain\Validation\PlayerValidation;
use PHPUnit\Framework\TestCase;

class PlayerValidationTest extends TestCase
{
    /** @test */
    public function it_should_throw_property_no_exists_exception()
    {
        $this->expectException(PropertyNotExistsException::class);
        PlayerValidation::validate([]);
    }

    /** @test */
    public function it_should_throw_empty_argument_exception()
    {
        $this->expectException(EmptyArgumentException::class);
        PlayerValidation::validate(["name" => "", "price" => "", "position" => "", "team" => "team"]);
    }

    /** @test */
    public function it_should_throw_position_not_found_exception()
    {
        $this->expectException(PositionNotFoundException::class);
        PlayerValidation::validate(["name" => "Test player", "price" => 100, "position" => "notfoundposition", "team" => 4]);
    }

    /** @test */
    public function it_should_be_true()
    {
        PlayerValidation::validate(["name" => "Test player", "price" => 100, "position" => "goalkeeper", "team" => 4]);
        $this->assertTrue(true);
    }
}
