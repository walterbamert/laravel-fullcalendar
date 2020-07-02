<?php

namespace SMPT\Fullcalendar\Test\Integration;

/**
 * Class EventTest
 * @package SMPT\Fullcalendar\Test\Integration
 */
abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Do any setup
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \SMPT\Fullcalendar\FullcalendarServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Fullcalendar' => \SMPT\Fullcalendar\Facades\Fullcalendar::class,
        ];
    }
}