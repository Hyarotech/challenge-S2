<?php
/*
*@Author: Houmame LAZAR <houms937@gmail.com>
*@Date: 03/01/2022 at 10:47
*@Class: Csrf
*@NameSpace: Core
*/

namespace Core;

use DateTime;

class Csrf
{
    private string $token;
    private int $expireAt;

    public bool $remove = false;

    public function __construct(string $id,int $time = 3600)
    {
        $this->token = uniqid(token(), true);
        $now = time();
        $this->expireAt = $now + $time;
        $_SESSION['csrf'][$id] = $this;
    }


    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return float|int
     */
    public function getExpireAt()
    {
        return $this->expireAt;
    }

}