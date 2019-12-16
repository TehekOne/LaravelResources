<?php

namespace TehekOne\Laravel\Resources\Concerns;

use Illuminate\Support\Collection;
use TehekOne\Laravel\Resources\Filters\FilterCollection;
use TehekOne\Laravel\Resources\Models\Preset;

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
        return Preset::where('resource', static::class)->orderBy('title')->get()
            ->transform(function ($item) {
                $item->query = http_build_query(json_decode($item->data, true));

                return $item;
            })
            ->map(static function ($item) {
                return $item->only('id', 'title', 'query');
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
        return collect($data)->filter(function ($value, $key) {
            /** @var FilterCollection $this ->filter */
            if ($this->filters->has($key)) {
                return [$key => $value];
            }
        });
    }
}
