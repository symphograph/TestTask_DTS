<?php

namespace App\Client;

use App\Helpers\BindTrait;
use App\Helpers\ListTrait;

class ClientList
{
    use BindTrait;
    use ListTrait;

    const tableName = 'clients';

    public array $list = [];

    public function initGeneratedList(int $length = 5): void
    {
        $this->list = [];
        for ($i = 1; $i <= $length; $i++) {
            $client = ClientGenerator::create($i);
            $this->list[] = $client;
        }
    }
}