<?php

namespace TehekOne\Laravel\Resources\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Filter
 *
 * @package TehekOne\Laravel\Resources\Models
 */
class Filter extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'resource_filter_presets';

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
