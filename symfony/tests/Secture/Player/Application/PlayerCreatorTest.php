<?php

namespace App\Tests\Secture\Player\Application;

use App\Secture\Player\Application\PlayerCreator;
use App\Secture\Player\Domain\ConvertCurrency;
use App\Secture\Player\Domain\PlayerRepository;
use PHPUnit\Framework\TestCase;

class PlayerCreatorTest extends TestCase
{
    /** @var MockTestInterface/PlayerRepository */
    private $repository;

    /** @var MockTestInterface/ConvertCurrency */
    private $convertCurrency;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->repository ?: $this->createMock(PlayerRepository::class);
        $this->repository->method('create')->willReturn(1);

        $this->convertCurrency = $this->convertCurrency ?: $this->createMock(ConvertCurrency::class);
        $this->convertCurrency->method('convert')->willReturnSelf();
    }

    public function testCreate()
    {
        $playerCreator = new PlayerCreator($this->repository, $this->convertCurrency);
        $this->assertEquals(1, $playerCreator->create(["name" => "Test player", "price" => 100, "position" => "goalkeeper", "team" => 4]));
    }
}
