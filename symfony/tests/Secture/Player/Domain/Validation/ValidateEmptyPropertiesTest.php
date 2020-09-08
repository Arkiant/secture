<?php

namespace App\Tests\Secture\Player\Domain\Validation;

use App\Secture\Player\Domain\Validation\ValidateEmptyProperties;
use PHPUnit\Framework\TestCase;

class ValidateEmptyPropertiesTest extends TestCase
{
    /** @test */
    public function it_should_be_empty_values()
    {
        $validateEmpty = ValidateEmptyProperties::validate(["name" => "", "price" => "", "position" => "", "team" => "team"]);
        $this->assertFalse($validateEmpty["result"]);
        $this->assertNotEmpty($validateEmpty["values"]);
    }

    /** @test */
    public function it_shoud_do_not_be_empty_values()
    {
        $validateEmpty = ValidateEmptyProperties::validate(["name" => "test", "price" => 400, "position" => "goalkeeper", "team" => 5]);
        $this->assertTrue($validateEmpty["result"]);
        $this->assertEmpty($validateEmpty["values"]);
    }
}
