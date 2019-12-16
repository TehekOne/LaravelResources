<?php

namespace TehekOne\Laravel\Resources\Filters\Templates;

use Illuminate\Http\Request;
use TehekOne\Laravel\Resources\Filters\Filter;

/**
 * Class SelectFilter
 *
 * @package TehekOne\Laravel\Resources\Filters\Templates
 */
abstract class SelectFilter extends Filter
{
    /**
     * @var string
     */
    protected $template = 'filters::filter_select';

    /**
     * @var string
     */
    protected $url;

    /**
     * Get the filter's fetch url.
     *
     * @return string
     */
    public function url()
    {
        return $this->url;
    }

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
