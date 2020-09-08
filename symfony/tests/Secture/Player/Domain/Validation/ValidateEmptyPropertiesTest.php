<?php

namespace App\Tests\Secture\Player\Domain\Validation;

use App\Secture\Player\Domain\Validation\ValidateEmptyProperties;
use PHPUnit\Framework\TestCase;

class ValidateEmptyPropertiesTest extends TestCase
{
    public function testEmptyArgumentEmptyProperties()
    {
        $validateEmpty = ValidateEmptyProperties::validate(["name" => "", "price" => "", "position" => "", "team" => "team"]);
        $this->assertFalse($validateEmpty["result"]);
        $this->assertNotEmpty($validateEmpty["values"]);
    }

    public function testEmptyProperties()
    {
        $validateEmpty = ValidateEmptyProperties::validate(["name" => "test", "price" => 400, "position" => "goalkeeper", "team" => 5]);
        $this->assertTrue($validateEmpty["result"]);
        $this->assertEmpty($validateEmpty["values"]);
    }
}
