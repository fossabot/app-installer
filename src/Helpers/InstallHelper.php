<?php
/*
 * Copyright (c) 2021 NobiDev
 */

declare(strict_types=1);

namespace NobiDev\AppInstaller\Helpers;

use Illuminate\Support\Facades\DB;
use function in_array;

/**
 * @package NobiDev\AppInstaller\Helpers
 */
class InstallHelper
{
    public static function isReady(): bool
    {
        return self::isSystemReady() && self::isDatabaseReady();
    }

    public static function isSystemReady(): bool
    {
        return self::isServerReady() && self::isFolderReady();
    }

    public static function isServerReady(): bool
    {
        return ServerHelper::isOk();
    }

    public static function isFolderReady(): bool
    {
        return !in_array(false, PermissionHelper::check(), true);
    }

    public static function isDatabaseReady(): bool
    {
        return (bool)DB::connection()->getPdo();
    }
}
