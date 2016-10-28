<?php

namespace App\tests;

use Mockery as M;
use App\Services\UrlShort\UrlShortAbstract;

/**
 * Class DriversFactoryTest.
 *
 * @category Test Class
 *
 * @author  Mahmoud Zalt <mahmoud@vinelab.com>
 */
class DriversFactoryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        M::close();
        parent::tearDown();
    }

    private function driverParameters()
    {
        return [
            'domain' => 'https://api-ssl.bitly.com',
            'endpoint' => '/v3/shorten',
            'token' => '1234567890qwertyuiopasdfghjklzxcvbnm',
        ];
    }

    /**
     * the initializing a bitly driver using the factory.
     */
    public function testInitializingBitlyDriver()
    {
        $driverName = 'bitly';
        $driverParameters = $this->driverParameters();

        $driver = DriversFactory::make($driverName, $driverParameters);

        $this->assertInstanceOf('App\Services\UrlShort\Bitly\BitlyShorter', $driver);
    }
    /**
     * the initializing a NULL driver.
     *
     * @expectedException Vinelab\UrlShortener\Exceptions\MissingConfigurationException
     */
    public function testMissingDriverName()
    {
        $driverName = '';
        $driverParameters = $this->driverParameters();

        DriversFactory::make($driverName, $driverParameters);
    }
    /**
     * the initializing a non supported driver.
     *
     * @expectedException Vinelab\UrlShortener\Exceptions\UnsupportedDriverException
     */
    public function testNonSupportedDriver()
    {
        $driverName = 'NonSupported';
        $driverParameters = $this->driverParameters();

        DriversFactory::make($driverName, $driverParameters);
    }
    /**
     * test initializing an object of the factory normally.
     */
    public function testInitializingFactoryNormally()
    {
        $driverName = 'bitly';
        $driverParameters = $this->driverParameters();

        $driver = (new DriversFactory())->make($driverName, $driverParameters);

        $this->assertInstanceOf('App\Services\UrlShort\Bitly\BitlyShorter', $driver);
    }
}