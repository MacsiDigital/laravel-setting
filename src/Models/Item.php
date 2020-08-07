<?php

namespace Setting\Models;

use Illuminate\Database\Eloquent\Model;
use Setting\Contracts\Item as Contract;

class Item extends Model implements Contract
{
    protected $fillable = [
        'name', 'description', 'key', 'value', 'autoload',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('setting.table_names.items'));
    }

    public function group()
    {
        return $this->belongsTo(config('setting.models.group'), config('setting.foreign_keys.item'));
    }
}
