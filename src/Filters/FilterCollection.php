<?php

namespace TehekOne\Laravel\Resources\Filters;

use Illuminate\Http\Request;
use InvalidArgumentException;

/**
 * Class FilterCollection
 *
 * @package App\Filters
 */
class FilterCollection
{
    /**
     * @var array
     */
    public $items;

    /**
     * FilterCollection constructor.
     *
     * @param array $filters
     */
    public function __construct(array $filters)
    {
        $this->items = collect($filters)->mapWithKeys(static function ($filter) {
            /** @var Filter $filter */
            return [$filter->key() => $filter];
        })->toArray();
    }

    /**
     * Get filter by name.
     *
     * @param $name
     *
     * @return mixed
     */
    public function get($name)
    {
        if (!$this->has($name)) {
            throw new InvalidArgumentException("The filter `{$name}` is not registered in this resource.");
        }

        return $this->items[$name];
    }

    /**
     * Append filter to set.
     *
     * @param $key
     * @param $value
     *
     * @return FilterCollection
     */
    public function set($key, $value)
    {
        if (!$value instanceof Filter) {
            throw new InvalidArgumentException("{$key} is not a valid filter.");
        }

        $this->items[$key] = $value;

        return $this;
    }

    /**
     * Determine if an filter exists in the collection by key.
     *
     * @param $name
     *
     * @return bool
     */
    public function has($name)
    {
        return isset($this->items[$name]);
    }

    /**
     * Get count of registered filters.
     *
     * return int
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * Calculate count of the selected filters.
     *
     * @param Request $request
     *
     * @return int
     */
    public function selected(Request $request)
    {
        return collect($request->all())->filter(function ($value, $key) {
            return $this->has($key) && $value;
        });
    }
}
