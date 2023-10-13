<?php

namespace App\Order;

use App\Helpers\DB;
use App\TestDataCreator;
use PHPUnit\Framework\TestCase;

class OrderListTest extends TestCase
{
    public function testCreateData()
    {
        TestDataCreator::createData(100);

        $this->assertTrue(DB::isTableExists('orders'));
        $this->assertTrue(DB::isTableExists('merchandise'));
        $this->assertTrue(DB::isTableExists('clients'));
        $this->assertTrue(file_exists(OrderGenerator::getFullPath()));
    }


    /**
     * @depends testCreateData
     */
    public function testByFile()
    {
        $errorsFilePath = OrderList::getErrorFilePath();
        $OrderList = OrderList::byFile();
        $this->assertTrue(file_exists($errorsFilePath));
        $OrderList->putListToDB();
        $this->assertTrue(!!Order::byID(1));
    }
}
