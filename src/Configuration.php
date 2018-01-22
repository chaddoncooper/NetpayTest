<?php

namespace Netpay\Test;

class Configuration implements ConfigurationInterface
{
    protected $config;

    public function __construct()
    {
        $this->config = parse_ini_file(
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'configuration.ini',
            true);
    }

    public function mysql()
    {
        $sectionName = 'mysql';
        $this->checkAllRequiredOptionsAreConfigured($sectionName, array('hostname', 'username', 'password', 'database'));
        return $this->config[$sectionName];
    }

    protected function checkAllRequiredOptionsAreConfigured($sectionName, $requiredOptions = array())
    {
        foreach ($requiredOptions as $option) {
            if (!key_exists($option, $this->config[$sectionName]) || empty($this->config[$sectionName][$option])) {
                throw new \Exception('Configuration Error, ' . $sectionName . ' is missing the required ' .
                    $option . ' option.');
            }
        }
    }
}
