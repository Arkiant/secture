<?php

namespace App\Tests\Secture\Player\Domain;

use App\Secture\Player\Domain\PositionValidation;
use PHPUnit\Framework\TestCase;

class PositionValidationTest extends TestCase
{
    public function testExistsTrue()
    {
        $positionValidation = new PositionValidation();
        $exists = $positionValidation->exists("goalkeeper");
        $this->assertTrue($exists);
    }

    public function testsExistsFalse()
    {
        $positionValidation = new PositionValidation();
        $exists = $positionValidation->exists("notfoundposition");
        $this->assertFalse($exists);
    }
}
