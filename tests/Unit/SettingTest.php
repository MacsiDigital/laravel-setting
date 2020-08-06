<?php

namespace Setting\Tests\Unit;

use Setting\Models\Group;
use Setting\Models\Item;
use Setting\Tests\TestCase;

class SettingTest extends TestCase
{
    /** @test */
    public function a_setting_group_can_be_created()
    {
        $group = factory(Group::class)->create();

        $this->assertDatabaseHas('setting_groups', $group->getAttributes());
    }

    /** @test */
    public function a_setting_group_can_have_an_item()
    {
        $group = factory(Group::class)->create();

        $item = factory(Item::class)->make();

        $group->items()->save($item);

        $retreived_item = $group->items()->first();

        $this->assertTrue($retreived_item->name == $item->name);
    }

    /** @test */
    public function a_setting_item_can_be_created()
    {
        $item = factory(Item::class)->create();

        $this->assertDatabaseHas('setting_items', $item->getAttributes());
    }

    /** @test */
    public function a_group_can_be_autoloaded()
    {
        $group = factory(Group::class)->create(['autoload' => true]);

        $item = factory(Item::class)->make();

        $group->items()->save($item);

        $this->runServiceProviders($this->app);

        $this->assertTrue(config($group->identifier.'.'.$item->key) == $item->value);
    }

    /** @test */
    public function an_item_can_be_autoloaded()
    {
        $item = factory(Item::class)->create(['autoload' => true]);

        $this->runServiceProviders($this->app);

        $this->assertTrue(config($item->key) == $item->value);
    }
}
