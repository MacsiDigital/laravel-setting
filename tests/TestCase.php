<?php

namespace Setting\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Setting\Providers\SettingServiceProvider;

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

        $app['config']->set('setting.models.group', '\Setting\Models\Group');
        $app['config']->set('setting.models.item', '\Setting\Models\Item');

        $app['config']->set('setting.foreign_keys.group', 'setting_group_id');
        $app['config']->set('setting.foreign_keys.item', 'setting_item_id');
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
