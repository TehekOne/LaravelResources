<?php

namespace TehekOne\Laravel\Resources\Filters\Templates;

use TehekOne\Laravel\Resources\Filters\Filter;

/**
 * Class DateFilter
 *
 * @package App\Filters\Templates
 */
abstract class DateFilter extends Filter
{
    /**
     * @var string
     */
    protected $template = 'filters::filter_date';
}
