<?php

namespace TehekOne\Laravel\Resources\Filters\Templates;

/**
 * Class DateRangeFilter
 *
 * @package TehekOne\Laravel\Resources\Filters\Templates
 */
abstract class DateRangeFilter extends DateFilter
{
    /**
     * @var string
     */
    protected $template = 'filters::filter_date-range';
}
