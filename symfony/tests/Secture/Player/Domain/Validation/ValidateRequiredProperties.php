<?php

namespace App\Tests\Secture\Player\Domain\Validation;

use App\Secture\Player\Domain\Validation\ValidateRequiredProperties;
use PHPUnit\Framework\TestCase;

class ValidateRequiredPropertiesTest extends TestCase
{

    public function testPropertyNotExistsValidateProperties()
    {
        $validateProperties = ValidateRequiredProperties::validate([]);
        $this->assertFalse($validateProperties["result"]);
        $this->assertNotEmpty($validateProperties["values"]);
    }

    public function testPropertyValidateProperties()
    {
        $validateProperties = ValidateRequiredProperties::validate(["name" => "", "price" => "", "position" => "", "team" => "team"]);
        $this->assertTrue($validateProperties["result"]);
        $this->assertEmpty($validateProperties["values"]);
    }
}
