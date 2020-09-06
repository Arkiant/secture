<?php

namespace App\Secture\PlayerFilters\Domain;

/**
 * FilterBy interface used by strategy pattern on filter data
 */
interface FilterBy
{
    public function execute(array $list, array $criteria): array;
}
