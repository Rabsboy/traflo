<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

public static function getValue($key)
{
    return optional(static::where('key', $key)->first())->value;
}
}

