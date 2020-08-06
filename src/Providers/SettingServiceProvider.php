<?php

namespace Setting\Providers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Setting\Contracts\Group as GroupContract;
use Setting\Contracts\Item as ItemContract;
use Setting\Facades\Group;
use Setting\Facades\Item;

class SettingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path('config.php'),
            ], 'setting-config');

            $this->publishes($this->getMigrationStubs(), 'setting-migrations');
        }

        $this->registerModelBindings();

        $this->processAutoloads();
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php',
            'setting'
        );
    }

    protected function registerModelBindings()
    {
        $config = $this->app->config['setting.models'];

        $this->app->bind('setting.group', GroupContract::class);
        $this->app->bind('setting.item', ItemContract::class);

        $this->app->bind(GroupContract::class, $config['group']);
        $this->app->bind(ItemContract::class, $config['item']);
    }

    protected function getMigrationStubs()
    {
        $global_migrations = collect((new Filesystem)->files(database_path('/migrations')));

        $migrations = [];
        foreach ((new Filesystem)->files(__DIR__.'/../../database/migrations/stubs') as $migration) {
            if (! $global_migrations->contains(function ($value, $key) use ($migration) {
                if (Str::contains($value->getRelativePathname(), $migration->getFilenameWithoutExtension())) {
                    return true;
                }
            })) {
                $migrations[__DIR__.'/../../database/migrations/stubs/'.$migration->getRelativePathname()] = database_path('migrations/'.date('Y_m_d_His').'_'.$migration->getFilenameWithoutExtension());
            }
        }

        return $migrations;
    }

    protected function processAutoloads()
    {
        try {
            if (DB::connection()->getPdo()) {
                if (Schema::hasTable(config('setting.table_names.groups'))) {
                    Group::whereAutoload(true)->get()->each(function ($group) {
                        $group->items()->each(function ($item) use ($group) {
                            config([$group->identifier.'.'.$item->key => $item->value]);
                        });
                    });
                    Item::whereAutoload(true)->get()->each(function ($item) {
                        if ($item->group != null) {
                            config([$item->group->identifier.'.'.$item->key => $item->value]);
                        } else {
                            config([$item->key => $item->value]);
                        }
                    });
                }
            }
        } catch (\Exception $e) {
        }
    }
}
