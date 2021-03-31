<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand as Command;

class UseCaseMakeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:usecase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new UseCase class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'UseCase';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->laravel->basePath(trim('/stubs/usecase.stub', '/'));
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\UseCases';
    }
}
