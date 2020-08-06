<?php

namespace Setting\Models;

use Illuminate\Database\Eloquent\Model;
use Setting\Contracts\Item as Contract;

class Item extends Model implements Contract
{
    protected $table = 'setting_items';

    protected $fillable = [
        'name', 'description', 'key', 'value',
    ];

    public function group()
    {
        return $this->belongsTo(config('setting.models.group'), 'setting_group_id');
    }
}
