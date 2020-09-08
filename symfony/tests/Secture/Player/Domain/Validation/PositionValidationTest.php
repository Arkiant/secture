<?php

namespace App\Tests\Secture\Player\Domain\Validation;

use App\Secture\Player\Domain\Validation\PositionValidation;
use PHPUnit\Framework\TestCase;

class PositionValidationTest extends TestCase
{
    /** @test */
    public function it_should_exists()
    {
        $positionValidation = new PositionValidation();
        $exists = $positionValidation->validate("goalkeeper");
        $this->assertTrue($exists);
    }

    /** @test */
    public function it_should_not_exists()
    {
        $positionValidation = new PositionValidation();
        $exists = $positionValidation->validate("notfoundposition");
        $this->assertFalse($exists);
    }
}
