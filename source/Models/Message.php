<?php

declare(strict_types=1);

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use PDOException;

class Message extends DataLayer
{

    public function __construct()
    {
        parent::__construct("messages", ["message"], "id", true);
    }

    public function save(): bool
    {
        try {
            if (
                !parent::save()
            ) {
                return false;
            }

            return true;
        } catch (PDOException $exception) {
            $this->fail = $exception;
            return false;
        }
    }
}
