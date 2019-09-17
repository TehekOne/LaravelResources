<?php

namespace TehekOne\Laravel\Resources\Concerns;

use Illuminate\Http\Request;

/**
 * Trait HasWidgets
 *
 * @package App\Traits
 */
trait HasWidgets
{
    /**
     * Get the widgets available for the resource.
     *
     * @param Request $request
     * @return array
     */
    public function widgets(Request $request = null): array
    {
        return [
            // ...
        ];
    }
}
