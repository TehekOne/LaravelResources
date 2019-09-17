<?php

namespace TehekOne\Laravel\Resources\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ReflectionClass;
use Throwable;

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
    protected $items;

    /**
     * @var Request
     */
    protected $request;

    /**
     * FilterCollection constructor.
     *
     * @param Request $request
     * @param array $filters
     */
    public function __construct(Request $request, array $filters)
    {
        $this->request = $request;

        $this->items = collect($filters)->mapWithKeys(static function ($item) {
            $name = Str::snake((new ReflectionClass($item))->getShortName());

            return [$name => $item];
        })->toArray();
    }

    /**
     * @return string
     * @throws Throwable
     */
    public function __toString()
    {
        return $this->render();
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
     * Calculate count of the selected filters.
     *
     * @return int
     */
    public function selected()
    {
        return collect($this->request->all())->filter(function ($value, $key) {
            return $this->has($key) && $value;
        })->count();
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
     * Render filters into variable.
     *
     * @return string
     * @throws Throwable
     */
    public function render()
    {
        $filters = '';

        if ($this->count()) {
            foreach ($this->items as $filter) {
                $filters .= new $filter;
            }
        }

        return $filters;
    }
}
