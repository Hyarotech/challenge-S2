<?php

namespace Core\enums;

enum Role: string
{
    case ADMIN = "ADMIN";
    case USER = "USER";
    case GUEST = "GUEST";
}