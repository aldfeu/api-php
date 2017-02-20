<?php

namespace Dacast\Elements;

use Dacast\Rest;

class Account
{
    /**
     * @var Rest
     */
    private $rest;

    public function __construct(Rest $rest)
    {
        $this->rest = $rest;
    }

    public function sells()
    {
        $sells = $this->rest->get('account/sells');
        return $sells;
    }
}