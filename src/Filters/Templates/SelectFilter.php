<?php

namespace TehekOne\Laravel\Resources\Filters\Templates;

use Illuminate\Http\Request;
use TehekOne\Laravel\Resources\Filters\Filter;

/**
 * Class SelectFilter
 *
 * @package App\Filters\Templates
 */
abstract class SelectFilter extends Filter
{
    /**
     * @var string
     */
    protected $template = 'filters::filter_select';

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
