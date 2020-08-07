<?php

namespace Setting\Models;

use Illuminate\Database\Eloquent\Model;
use Setting\Contracts\Group as Contract;

class Group extends Model implements Contract
{
    protected $fillable = [
        'identifier', 'name', 'description', 'autoload'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('setting.table_names.groups'));
    }

    public function items()
    {
        return $this->hasMany(config('setting.models.item'), config('setting.foreign_keys.group'));
    }
}
