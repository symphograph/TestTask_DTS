<?php

namespace App\Order;

use App\Errors\MyErrors;
use App\Helpers\BindTrait;
use App\Helpers\Helpers;
use App\Helpers\ListTrait;


class OrderList
{
    use BindTrait;
    use ListTrait;

    const tableName = 'orders';
    const errorRelPath = '/tmp/orderErr.txt';

    /**
     * @var Order[]
     */
    private array $list     = [];
    private array $invalids = [];


    public static function byFile(string $pathToFile = ''): self
    {
        $self = new self();
        $self->initFromFile();
        $self->saveInvalids();
        return $self;
    }

    private function initFromFile(string $pathToFile = ''): void
    {
        if(empty($pathToFile)){
            $pathToFile = OrderGenerator::getFullPath();
        }

        if(!file_exists($pathToFile)){
            throw new MyErrors('file does not exist');
        }

        $lines = file($pathToFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            try {
                $order = Order::byLine($line);
                OrderValidator::byBind($order)->valid();
                $this->list[] = $order;
            } catch (\Throwable) {
                $this->invalids[] = $line;
            }
        }
    }

    private function saveInvalids(): void
    {
        if(empty($this->invalids)){
            return;
        }
        $data = implode(PHP_EOL, $this->invalids);
        $errFullPath = self::getErrorFilePath();
        Helpers::fileForceContents($errFullPath, $data);
    }

    public static function getErrorFilePath(): string
    {
        return dirname(__DIR__, 2) . self::errorRelPath;
    }
}
