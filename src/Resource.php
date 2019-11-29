<?php

namespace TehekOne\Laravel\Resources;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use TehekOne\Laravel\Resources\Filters\Filter;
use TehekOne\Laravel\Resources\Filters\FilterCollection;

/**
 * Class Resource
 *
 * @package TehekOne\Laravel\Resources
 */
abstract class Resource
{
    use \TehekOne\Laravel\Resources\Concerns\HasFilters,
        \TehekOne\Laravel\Resources\Concerns\HasPresets,
        \TehekOne\Laravel\Resources\Concerns\HasWidgets;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var
     */
    protected $data;

    /**
     * Apply the filters to the given query.
     *
     * @param Request $request
     * @return Builder
     */
    public static function apply(Request $request)
    {
        /** @var Resource $class */
        $class = static::class;
        $class = new $class;

        return static::applyFilters($request, $class->filters($request), static::query());
    }

    /**
     * Apply the filters to the given query.
     *
     * @param Request $request
     * @param array $filters
     * @param Builder $query
     * @return Builder
     */
    public static function applyFilters(Request $request, array $filters, Builder $query): Builder
    {
        collect($filters)->each(static function ($filter) use ($query, $request) {
            /**
             * @var Request $request
             * @var Filter $filter
             */
            if ($value = $request->input($filter->key())) {
                $filter->apply($query, $value);
            }
        });

        return $query;
    }

    /**
     * Get the builder for the resource's model
     *
     * @return Builder
     */
    public static function query(): Builder
    {
        /** @var Builder $model */
        return (new static::$model)->newQuery();
    }

    /**
     * Resource constructor.
     */
    public function __construct()
    {
        $this->request = request();

        $this->filters = new FilterCollection($this->filters($this->request));
    }

    /**
     * Return class name
     *
     * @return string
     */
    public function __toString()
    {
        return static::class;
    }
}
