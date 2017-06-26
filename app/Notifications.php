<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];
}
