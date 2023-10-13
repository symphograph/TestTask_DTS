<?php

namespace App\Merchandise;

use App\Helpers\BindTrait;

class Merchandise
{
    use BindTrait;
    const tableName = 'merchandise';

    protected int $id;
    protected string $name;
    protected float $price;


}