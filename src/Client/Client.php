<?php
namespace App\Client;

use App\Helpers\BindTrait;


class Client
{
    use BindTrait;
    const tableName = 'clients';

    protected int $id;
    protected string $name;
}
