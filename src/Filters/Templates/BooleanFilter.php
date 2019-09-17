<?php

namespace TehekOne\Laravel\Resources\Filters\Templates;

use Illuminate\Http\Request;
use TehekOne\Laravel\Resources\Filters\Filter;

/**
 * Class BooleanFilter
 *
 * @package App\Filters\Templates
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
     * @param Request $request
     *
     * @return array
     */
    public function options(Request $request)
    {
        return [
            //
        ];
    }
}
