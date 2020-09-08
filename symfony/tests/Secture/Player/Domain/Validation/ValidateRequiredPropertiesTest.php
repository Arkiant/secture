<?php

namespace App\Tests\Secture\Player\Domain\Validation;

use App\Secture\Player\Domain\Validation\ValidateRequiredProperties;
use PHPUnit\Framework\TestCase;

class ValidateRequiredPropertiesTest extends TestCase
{

    /** @test */
    public function it_should_not_exists_properties()
    {
        $validateProperties = ValidateRequiredProperties::validate([]);
        $this->assertFalse($validateProperties["result"]);
        $this->assertNotEmpty($validateProperties["values"]);
    }

    /** @test */
    public function it_should_exists_all_properties()
    {
        $validateProperties = ValidateRequiredProperties::validate(["name" => "", "price" => "", "position" => "", "team" => "team"]);
        $this->assertTrue($validateProperties["result"]);
        $this->assertEmpty($validateProperties["values"]);
    }
}
