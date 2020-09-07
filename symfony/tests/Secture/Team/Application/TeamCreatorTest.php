<?php

namespace App\Tests\Secture\Team\Application;

use App\Secture\Team\Application\TeamCreator;
use App\Secture\Team\Infraestructure\InmemTeamRepository;
use PHPUnit\Framework\TestCase;

class TeamCreatorTest extends TestCase
{
    public function testCreate()
    {
        $repository = new InmemTeamRepository();
        $teamCreator = new TeamCreator($repository);

        $this->assertEquals(1, $teamCreator->create(["name" => "Test name"])->getID());
    }
}
