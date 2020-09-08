<?php

namespace App\Tests\Secture\Player\Domain\Validation;

use App\Secture\Player\Domain\Validation\PositionValidation;
use PHPUnit\Framework\TestCase;

class PositionValidationTest extends TestCase
{
    public function testExistsTrue()
    {
        $positionValidation = new PositionValidation();
        $exists = $positionValidation->validate("goalkeeper");
        $this->assertTrue($exists);
    }

    public function testsExistsFalse()
    {
        $positionValidation = new PositionValidation();
        $exists = $positionValidation->validate("notfoundposition");
        $this->assertFalse($exists);
    }
}
