<?php

namespace TehekOne\Laravel\Resources\Commands;

use Illuminate\Console\GeneratorCommand;

/**
 * Class MakeFilterCommand
 *
 * @package TehekOne\Laravel\Resources\Commands
 */
class MakeFilterCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shine:filter
                                {name}
                                {--select}
                                {--boolean}
                                {--date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new filter class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Filter';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = null;

        if ($this->option('select')) {
            $stub = __DIR__.'/../../resources/stubs/select.filter.stub';
        } elseif ($this->option('boolean')) {
            $stub = __DIR__.'/../../resources/stubs/boolean.filter.stub';
        } elseif ($this->option('date')) {
            $stub = __DIR__.'/../../resources/stubs/date.filter.stub';
        } else {
            $stub = __DIR__.'/../../resources/stubs/filter.stub';
        }

        return $stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Filters';
    }
}
