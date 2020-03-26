<?php

namespace Setting;

use Setting\Contracts\Group as Contract;
use Illuminate\Database\Eloquent\Model;

class Group extends Model implements Contract
{
	protected $table = 'setting_groups';

    protected $fillable = [
        'identifier', 'name', 'description'
    ];

    public function items()
    {
        return $this->hasMany(config('setting.models.item'), 'setting_group_id');
    }

}