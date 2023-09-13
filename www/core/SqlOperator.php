<?php

namespace Core;

use Attribute;

#[Attribute] enum SqlOperator
{
    const EQUAL = "=";
    const NOT_EQUAL = "!=";
    const GREATER_THAN = ">";
    const GREATER_THAN_OR_EQUAL = ">=";
    const LESS_THAN = "<";
    const LESS_THAN_OR_EQUAL = "<=";
    const LIKE = "LIKE";
    const NOT_LIKE = "NOT LIKE";
    const IN = "IN";
    const NOT_IN = "NOT IN";
    const BETWEEN = "BETWEEN";
    const NOT_BETWEEN = "NOT BETWEEN";
    const IS_NULL = "IS NULL";
    const IS_NOT_NULL = "IS NOT NULL";
    const IS_TRUE = "IS TRUE";
    const IS_FALSE = "IS FALSE";
}
