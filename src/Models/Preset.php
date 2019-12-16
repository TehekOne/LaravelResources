<?php

namespace TehekOne\Laravel\Resources\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Preset
 *
 * @package TehekOne\Laravel\Resources\Models
 */
class Preset extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'resource_presets';

    /**
     * @var array
     */
    protected $casts = [
        'data' => 'json',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'resource',
        'data',
    ];
}
