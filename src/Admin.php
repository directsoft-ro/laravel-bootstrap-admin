<?php

namespace DirectsoftRo\LaravelBootstrapAdmin;

class Admin
{
    public static \Closure $authenticateUsingCallback;

    public static function authenticateUsing(callable $callback): void
    {
        static::$authenticateUsingCallback = $callback;
    }
}
