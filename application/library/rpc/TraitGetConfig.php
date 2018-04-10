<?php

/**
 * Trait Rpc_TraitGetConfig
 */
trait Rpc_TraitGetConfig
{

    /**
     * Get interface config by interface ID
     *
     * @param $interfaceId
     * @param string $configKey
     * @return bool
     */
    public static function getConfig($interfaceId, $configKey = '')
    {
        if (isset(self::$config[$interfaceId])) {
            if (strlen($configKey) && isset(self::$config[$interfaceId][$configKey])) {
                return self::$config[$interfaceId][$configKey];
            } else {
                return self::$config[$interfaceId];
            }
        } else {
            return false;
        }
    }
}