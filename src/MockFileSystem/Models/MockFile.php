<?php

namespace Netpay\Test\MockFileSystem\Models;

class MockFile extends MockNode 
{
    public function __construct($path)
    {
        parent::__construct($path);
    }
}
