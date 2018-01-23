<?php

namespace Netpay\Test\MockFileSystem;
use Netpay\Test\MockFileSystem\Models\MockFile;
use Netpay\Test\MockFileSystem\Models\MockDirectory;

class MockFileSystemSerialiser implements MockFileSystemSerialiserInterface
{
    public function deserialise($filePath)
    {
        $nodes = array();
        $handle = fopen($filePath, 'r');
        if ($handle) {
            $level = 0;
            $previousLevel = 0;
            $currentPath = '';
            
            while (($line = fgets($handle)) !== false) {
                $previousLevel = $level;
                $level = $this->countTabs($line);
                if (empty($currentPath)) {
                    $currentPath = trim($line);
                } else if ($this->lineIsFile($line)) {
                    $nodes[] = new MockFile($currentPath . DIRECTORY_SEPARATOR . trim($line));
                } else {
                    if ($level < $previousLevel) {
                        $currentPath = $this->getPathAtLevel($currentPath, $level) . trim($line);
                    } else {
                        $currentPath = $this->addToDirToPath($currentPath, trim($line));
                    }
                    $nodes[] = new MockDirectory($currentPath);
                }
            }
            fclose($handle);
        }
        return $nodes;
    }

    private function countTabs($line)
    {
        return strspn($line, "\t");
    }

    private function addToDirToPath($currentPath, $dir)
    {
        return rtrim($currentPath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $dir;
    }

    private function lineIsFile($line)
    {
        // Assumes it's a file if has file extension
        return substr(trim($line), -4, 1) == '.';
    }

    private function getPathAtLevel($path, $level)
    {
        return substr($path, 0, $this->strposOffset(DIRECTORY_SEPARATOR, $path, $level) + 1);
    }
       
    private function strposOffset($search, $string, $offset)
    {
        $arr = explode($search, $string);

        switch( $offset )
        {
            case $offset == 0:
            return false;
            break;
        
            case $offset > max(array_keys($arr)):
            return false;
            break;
    
            default:
            return strlen(implode($search, array_slice($arr, 0, $offset)));
        }
    }
}
