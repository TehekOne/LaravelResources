<?php

namespace TehekOne\Laravel\Resources\Concerns;

use Illuminate\Support\Collection;
use RuntimeException;
use TehekOne\Laravel\Resources\Models\Preset;

/**
 * Trait HasPresets
 *
 * @package App\Traits
 */
trait HasPresets
{
    /**
     * Get presets for the resource. For a specific user if specified.
     *
     * @param null $userId
     *
     * @return Collection
     */
    public function presets($userId = null)
    {
        $query = Preset::query()
            ->where('resource', static::class)
            ->orderBy('title');

        if ($userId) {
            $query->where('user_id', $userId);
        }

        return $query->get()
            ->transform(static function ($item) {
                $item->query = http_build_query($item->data, true);

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
        if (!property_exists($this, 'filters')) {
            throw new RuntimeException('Resource class does not use `HasFilters` trait');
        }

        return collect($data)->filter(function ($value, $key) {
            if ($this->filters->has($key)) {
                return [$key => $value];
            }
        });
    }
}
