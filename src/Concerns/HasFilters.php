<?php

namespace TehekOne\Laravel\Resources\Concerns;

use Illuminate\Http\Request;
use TehekOne\Laravel\Resources\Filters\FilterCollection;

/**
 * Trait HasFilters
 *
 * @package App\Traits
 */
trait HasFilters
{
    /**
     * @var FilterCollection
     */
    public $filters;

    /**
     * Get the filters available for the resource.
     *
     * @param Request $request
     *
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            // ...
        ];
    }
}
