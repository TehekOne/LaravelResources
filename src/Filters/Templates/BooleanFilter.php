<?php

namespace TehekOne\Laravel\Resources\Filters\Templates;

use Illuminate\Http\Request;
use TehekOne\Laravel\Resources\Filters\Filter;

/**
 * Class BooleanFilter
 *
 * @package TehekOne\Laravel\Resources\Filters\Templates
 */
abstract class BooleanFilter extends Filter
{
    /**
     * @var string
     */
    protected $template = 'filters::filter_boolean';

    /**
     * Get the filter's available options.
     *
     * @param Request|null $request
     *
     * @return array
     */
    public function options(Request $request = null)
    {
        return [
            //
        ];
    }
}
