<?php

namespace TehekOne\Laravel\Resources\Filters;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\View\View;
use ReflectionClass;
use ReflectionException;
use Throwable;

/**
 * Class Filter
 *
 * @property string $name
 * @property string $description
 * @property string $template
 *
 * @package TehekOne\Laravel\Resources\Filters
 */
abstract class Filter implements Renderable
{
    /**
     * The displayable name of the filter.
     *
     * @var string
     */
    protected $name = '';

    /**
     * The description of the filter.
     *
     * @var string
     */
    protected $description = '';

    /**
     * The template blade file of the filter.
     *
     * @var string
     */
    protected $template = '';

    /**
     * Apply the filter to the given query.
     *
     * @param Builder $query
     * @param mixed $value
     *
     * @return Builder
     */
    abstract public function apply(Builder $query, $value);

    /**
     * Get rendered html template.
     *
     * @return string
     * @throws Throwable
     */
    public function __toString()
    {
        return view($this->template, [
            'filter' => $this,
        ])->render();
    }

    /**
     * Get the displayable name of the filter.
     *
     * @return string
     * @throws ReflectionException
     */
    public function name()
    {
        return $this->name ?: (new ReflectionClass(static::class))->getShortName();
    }

    /**
     * Get the description of the filter.
     *
     * @return string
     */
    public function description()
    {
        return $this->description;
    }

    /**
     * Get the key for the filter.
     *
     * @return string
     * @throws ReflectionException
     */
    public function key()
    {
        return Str::snake((new ReflectionClass(static::class))->getShortName());
    }

    /**
     * Render html template.
     *
     * @return View
     */
    public function render()
    {
        return view($this->template, [
            'filter' => $this,
        ]);
    }
}
