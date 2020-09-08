<?php

namespace App\Tests\Secture\Team\Application;

use App\Secture\Team\Application\TeamCreator;
use App\Secture\Team\Domain\TeamID;
use App\Secture\Team\Domain\TeamRepository;
use PHPUnit\Framework\TestCase;

class TeamCreatorTest extends TestCase
{
    /** @var MockTestInterface/TeamRepository */
    private $repository;

    protected function setUp()
    {
        parent::setUp();
        $this->repository = $this->repository ?: $this->createMock(TeamRepository::class);
        $this->repository->method('create')->willReturn(new TeamID(1));
    }

    public function testCreate()
    {
        $teamCreator = new TeamCreator($this->repository);
        $this->assertEquals(1, $teamCreator->create(["name" => "Test name"])->getID());
    }
}
