<h2 align="center">
    Laravel Resource
</h2>

<p align="center">
    <a href="https://packagist.org/packages/tehekone/laravel-resources"><img src="https://poser.pugx.org/tehekone/laravel-resources/v/stable?format=flat-square" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/tehekone/laravel-resources"><img src="https://poser.pugx.org/tehekone/laravel-resources/license?format=flat-square" alt="License"></a>
    <a href="https://packagist.org/packages/tehekone/laravel-resources"><img src="https://poser.pugx.org/tehekone/laravel-resources/downloads" alt="Total Downloads"></a>
</p>

## Table of Contents

<details><summary>Click to expand</summary><p>

- [Introduction](#introduction)
- [Installation](#installation)
- [Usage](#usage)
    - [Defining Resource](#defining-resource)
    - [Defining Filters](#defining-filters)
    - [Cheat sheet](#cheat-sheet)

</p></details>

##Introduction

##Installation

You can install this package via composer using:

```bash
composer require tehekone/laravel-resources
```

Alternatively, add these two lines to your composer require section:

```json
{
    "require": {
        "tehekone/laravel-resources": "^0.3"
    }
}
```

##Usage

...

###Defining Resource

...

###Defining Filters
- [Select Filters](#select-filters)
- [Boolean Filters](#boolean-filters)
- [Date Filters](#date-filters)
- [Filter Titles](#filter-titles)
- [Dynamic Filters](#dynamic-filters)
- [Render Filters](#render-filters)

####Select Filters

```shell script
php artisan shine:filter UserType --select
```

Each select filter contains two methods: `apply` and `options`. The `apply` method is responsible for modifying the query to achieve the desired filter state, while the `options` method defines the "values" the filter may have. Let's take a look at an example `UserType` filter:

```php
<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use TehekOne\Laravel\Resources\Filters\Templates\SelectFilter;

/**
 * Class UserType
 *
 * @package App\Filters
 */
class UserType extends SelectFilter
{
    /**
     * Apply the filter to the given query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $query, $value)
    {
        return $query->where('type', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function options(Request $request)
    {
        return [
            'admin' => 'Administrator', 
            'editor' => 'Editor', 
        ];
    }
}
```

The `options` method should return an array of keys and values. The array's values will be passed into the `apply` method as the `$value` argument. This filter defines two possible values: `admin` and `editor`.

As you can see in the example above, you may leverage the incoming $value to modify your query. The apply method should return the modified query instance.

####Boolean Filters

You may generate a boolean filter using the `shine:filter --boolean` Artisan command.

```shell script
php artisan shine:filter UserType --select
```

Each boolean filter contains two methods: `apply` and `options`. The `apply` method is responsible for modifying the query to achieve the desired filter state, while the options method defines the "values" the filter may have.

When building boolean filters, the `$value` argument passed to the `apply` method is an associative array containing the boolean value of each of your filter's options.

Let's take a look at an example `UserType` filter:

```php
<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use TehekOne\Laravel\Resources\Filters\Templates\BooleanFilter;

/**
 * Class UserType
 *
 * @package App\Filters
 */
class UserType extends BooleanFilter
{
    /**
     * Apply the filter to the given query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $query, $value)
    {
        return $query->where('is_admin', $value['admin'])
                     ->where('is_editor', $value['editor']);
    }

    /**
     * Get the filter's available options.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function options(Request $request)
    {
        return [
            'admin' => 'Administrator', 
            'editor' => 'Editor', 
        ];
    }
}
```

The `options` method should return an array of keys and values. The array's values will be passed into the `apply` method as the `$value` argument. This filter defines two possible values: `admin` and `editor`.

As you can see in the example above, you may leverage the incoming `$value` to modify your query. The `apply` method should return the modified query instance.

####Date Filters

You may generate a date filter using the `shine:filter --date` Artisan command.

```shell script
php artisan shine:filter CreatedFilter --date
```

Each date filter contains one method: `apply`. The `apply` method is responsible for modifying the query to achieve the desired filter state.

When building date filters, the `$value` argument passed to the `apply` method is the string representation of the selected date.

Let's take a look at an example `CreatedFilter` filter:

```php
<?php

namespace App\Filters;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use TehekOne\Laravel\Resources\Filters\Templates\DateFilter;

/**
 * Class CreatedFilter
 *
 * @package App\Filters
 */
class CreatedFilter extends DateFilter
{
    /**
     * Apply the filter to the given query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $query, $value)
    {
        return $query->where('created_at', '<=', Carbon::parse($value));
    }
}
```

As you can see in the example above, you may leverage the incoming `$value` to modify your query. The `apply` method should return the modified query instance.

####Filter Titles

If you would like to change the filter title, you may define a `name` property on the filter class:

```php
/**
 * The displayable name of the filter.
 *
 * @var string
 */
public $name = 'Filter Title';
```

If the name of your filter needs to be dynamic, you should create a `name` method on the filter class:

```php
/**
 * Get the displayable name of the filter.
 *
 * @return string
 */
public function name()
{
    return 'Filter By ' . $this->custom;
}
```

####Dynamic Filters

There may be times when you want to create a dynamic filter which filters on different columns. In addition to passing the column name that we want to filter on in the constructor, we'll also need to override the `key` method.

Let's take a look at an example `TimestampFilter` filter:

```php
<?php

namespace App\Filters;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use TehekOne\Laravel\Resources\Filters\Templates\DateFilter;

/**
 * Class TimestampFilter
 *
 * @package App\Filters
 */
class TimestampFilter extends DateFilter
{
    /**
     * The column that should be filtered on.
     *
     * @var string
     */
    protected $column;

    /**
     * Create a new filter instance.
     *
     * @param string $column
     * @return void
     */
    public function __construct($column)
    {
        $this->column = $column;
    }

    /**
     * Apply the filter to the given query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $query, $value)
    {
        return $query->where($this->column, '<=', Carbon::parse($value));
    }

    /**
     * Get the key for the filter.
     *
     * @return string
     */
    public function key()
    {
        return 'timestamp_'.$this->column;
    }
}
```

When registering the filter on a resource, pass the name of the column you wish to filter on:

```php
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
        new \App\Filters\TimestampFilter('created_at'),
        new \App\Filters\TimestampFilter('updated_at'),
    ];
}
```

####Render Filters

By default all defined filter in resource renders by row. Let's take a look at an example:

```blade
@foreach ($resource->filters->items as $name => $filter)
    {!! $filter->render() !!}
@endforeach

{{-- Or simple --}}

@foreach ($resource->filters->items as $name => $filter)
    {!! $filter !!}
@endforeach
```

But you also may want to take filter by `key` and render it separately. From the example with the `UserType` filter Let's take how it works by this example:

```blade
{!! $resource->filters->get('user_type')->render() !!}

{{-- Or simple --}}

{!! $resource->filters->get('user_type') !!}
```

For get all user selected filters you may use `selected` method and simple take `count`. Let's take a look at an example:

```php
$resource->filters->selected($request);
$resource->filters->selected($request)->count();
```

###Cheat sheet
```php
// Get filter by key
$resource->filters->get($key);

// Set filter by key
$resource->filters->set($key, $value);

// Get all filters
$resource->filters->items;

// Get selected filters
$resource->filters->selected($request);
```

## Credits

Inspired by [Laravel Nova](https://nova.laravel.com)

- [TehekOne](https://github.com/tehekone)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
