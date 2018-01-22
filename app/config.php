<?php

return array(
    Netpay\Test\ConfigurationInterface::class => DI\get(Netpay\Test\Configuration::class),
    Netpay\Test\MockFileSystem\MockFileSystemSerialiserInterface::class => DI\get(Netpay\Test\MockFileSystem\MockFileSystemSerialiser::class),
);
