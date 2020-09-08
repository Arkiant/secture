<?php

namespace App\Tests\Secture\Player\Application;

use App\Secture\Player\Application\PlayerCreator;
use App\Secture\Player\Domain\ConvertCurrency;
use App\Secture\Player\Domain\PlayerRepository;
use App\Secture\Team\Domain\TeamRepository;
use PHPUnit\Framework\TestCase;

class PlayerCreatorTest extends TestCase
{
    /** @var MockTestInterface/PlayerRepository */
    private $playerRepository;

    /** @var MockTestInterface/TeamRepository */
    private $teamRepository;

    /** @var MockTestInterface/ConvertCurrency */
    private $convertCurrency;

    protected function setUp(): void
    {
        parent::setUp();
        $this->playerRepository = $this->playerRepository ?: $this->createMock(PlayerRepository::class);

        $this->teamRepository = $this->teamRepository ?: $this->createMock(TeamRepository::class);

        $this->convertCurrency = $this->convertCurrency ?: $this->createMock(ConvertCurrency::class);
        $this->convertCurrency->method('convert')->willReturnSelf();
    }

    /** @test */
    public function it_should_create_a_new_player(): void
    {
        $this->playerRepository->method('create')->willReturn(1);
        $this->teamRepository->method('existsByID')->willReturn(false);
        $playerCreator = new PlayerCreator($this->playerRepository, $this->teamRepository, $this->convertCurrency);
        $this->assertEquals(1, $playerCreator->create(["name" => "Test player", "price" => 100, "position" => "goalkeeper", "team" => 4]));
    }
}
