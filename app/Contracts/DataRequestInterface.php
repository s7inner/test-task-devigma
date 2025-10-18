<?php

namespace App\Contracts;

interface DataRequestInterface
{
    public function getDto(): object;
}
