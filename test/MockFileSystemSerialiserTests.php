<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Netpay\Test\MockFileSystem\MockFileSystemSerialiser;

class MockFileSystemSerialiserTests extends TestCase
{
    protected $mockFileSystemSerialiser;
    protected $nodes;

    public function setUp()
    {
        $this->mockFileSystemSerialiser = new MockFileSystemSerialiser();
        $this->nodes = $this->mockFileSystemSerialiser->deserialise(__DIR__ . '/../mockFileSystem.txt');
    }

    public function tearDown()
    {
        $this->mockFileSystemSerialiser = null;
    }

    public function testTotalNodeCount()
    {
        $this->assertEquals(14, count($this->nodes));
    }

    public function testTotalFiles()
    {
        $files = 0;
        foreach($this->nodes as $node)
        {
            if (is_a($node, 'Netpay\Test\MockFileSystem\Models\MockFile')) {
                $files++;
            }
        }
        $this->assertEquals(8, $files);
    }

    public function testTotalDirectories()
    {
        $directories = 0;
        foreach($this->nodes as $node)
        {
            if (is_a($node, 'Netpay\Test\MockFileSystem\Models\MockDirectory')) {
                $directories++;
            }
        }
        $this->assertEquals(6, $directories);
    }
}