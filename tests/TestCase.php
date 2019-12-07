<?php

namespace Setting\Tests;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Setting\Providers\SettingServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{

    public function setUp() : void
    {
        parent::setUp();

        $this->getEnvironmentSetup($this->app);

        $this->setUpDatabase($this->app);

        $this->withFactories(__DIR__.'/../database/factories');

    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function runServiceProviders($app)
    {
        $provider = new SettingServiceProvider($app);
        $provider->register();
        $provider->boot();
    }

    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('setting.table_names.groups', 'setting_groups');
        $app['config']->set('setting.table_names.items', 'setting_items');

        $app['config']->set('setting.models.group', '\Setting\Group');
        $app['config']->set('setting.models.item', '\Setting\Item');
    }

    /**
     * Set up the database.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function setUpDatabase($app)
    {
        include_once __DIR__.'/../database/migrations/stubs/create_setting_tables.php.stub';

        (new \CreateSettingTables())->up();
    }

}