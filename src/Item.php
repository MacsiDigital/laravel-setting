<?php

namespace Setting;

use Setting\Contracts\Item as Contract;
use Setting\Group;
use Illuminate\Database\Eloquent\Model;

class Item extends Model implements Contract
{
	protected $table = 'setting_items';

    protected $fillable = [
        'name', 'description', 'key', 'value'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'setting_group_id');
    }

}
