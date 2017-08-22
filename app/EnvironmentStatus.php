<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnvironmentStatus extends Model
{
    /**
     * @var string
     */
    protected $table = 'environment_status';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'description'];
}
