<?php

namespace TehekOne\Laravel\Resources\Filters\Templates;

use TehekOne\Laravel\Resources\Filters\Filter;

/**
 * Class InputFilter
 *
 * @package TehekOne\Laravel\Resources\Filters\Templates
 */
abstract class InputFilter extends Filter
{
    /**
     * @var string
     */
    protected $template = 'filters::filter_input';
}
