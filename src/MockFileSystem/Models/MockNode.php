<?php

namespace Netpay\Test\MockFileSystem\Models;

class MockNode
{
    public $Id;
    public $Path;

    public function __construct($path)
    {
        $this->Path = $path;
    }
}
