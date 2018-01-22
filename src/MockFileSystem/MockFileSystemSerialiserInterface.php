<?php

namespace Netpay\Test\MockFileSystem;

interface MockFileSystemSerialiserInterface
{
    public function deserialise($filePath);
}
