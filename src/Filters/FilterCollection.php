<?php

namespace TehekOne\Laravel\Resources\Filters;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ReflectionClass;

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
        $this->items = collect($filters)->mapWithKeys(static function ($item) {
            $name = Str::snake((new ReflectionClass($item))->getShortName());

            return [$name => $item];
        })->toArray();
    }

    /**
     * Get filter by name.
     *
     * @param $name
     *
     * @return mixed
     * @throws Exception
     */
    public function get($name)
    {
        if (!$this->has($name)) {
            throw new Exception("The filter `{$name}` is not registered in this resource.");
        }

        return $this->items[$name];
    }

    /**
     * Append filter to set.
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $this->items[$key] = $value;
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
