<?php

namespace Netpay\Test\MockFileSystem\Models;

class MockDirectory extends MockNode
{
    public function __construct($path)
    {
        parent::__construct($path);
    }
}
