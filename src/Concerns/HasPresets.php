<?php

namespace TehekOne\Laravel\Resources\Concerns;

use Illuminate\Support\Collection;
use TehekOne\Laravel\Resources\Models\Filter;

/**
 * Trait HasPresets
 *
 * @package App\Traits
 */
trait HasPresets
{
    /**
     * Get presets for the resource.
     *
     * @return array
     */
    public function presets()
    {
        return Filter::where('resource', static::class)->orderBy('title')->get()
            ->transform(function ($item) {
                $item->link = $this->request->fullUrlWithQuery($item->data);

                return $item;
            })
            ->map(static function ($item) {
                return $item->only('title', 'link');
            });
    }

    /**
     * Get only available query parameters for registered filters.
     *
     * @param array $data
     *
     * @return Collection
     */
    public function prepare(array $data)
    {
        return collect($data)->mapWithKeys(function ($value, $key) {
            if ($this->filters->has($key)) {
                return [$key => $value];
            }
        });
    }
}
