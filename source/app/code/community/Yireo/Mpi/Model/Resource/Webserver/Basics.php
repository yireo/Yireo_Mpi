<?php
/**
 * Yireo Mpi for Magento
 *
 * @package     Yireo_Mpi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 * Get core versioning
 */
class Yireo_Mpi_Model_Resource_Webserver_Basics extends Yireo_Mpi_Model_Resource_Abstract
{
    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        $result = array();

        $result[] = $this->getMetric('sapi', $this->getSapi());
        $result[] = $this->getMetric('apache_version', $this->getApacheVersion());
        $result[] = $this->getMetric('system_memory', $this->getSystemMemory());

        return $result;
    }

    protected function getSapi()
    {
        return php_sapi_name();
    }

    protected function getApacheVersion()
    {
        if (function_exists('apache_get_version')) {
            return apache_get_version();
        }
    }

    protected function getSystemMemory()
    {
        $memory = trim(exec('cat /proc/meminfo|grep MemTotal|cut -d\: -f2'));
        $memory = explode(' ', $memory);
        $memory = $memory[0];

        if (empty($memory)) {
            return 0;
        }

        return $memory * 1024;
    }
}