
<?php

namespace App\tests;

use App\Services\UrlShort\Default\UrlHasher;

class UrlHasherTest extends PHPUnit_Framework_TestCase
{
    public function test_hashes_url()
    {
        $hasher = new UrlHasher(10);
        $this->assertEquals(10, strlen($hasher->make('example.com')));
    }
}