<?php

function translateColumn($context, $column)
{
    $locale = app()->getLocale();
    return `{$context}->{$column}_{$locale}`;
}