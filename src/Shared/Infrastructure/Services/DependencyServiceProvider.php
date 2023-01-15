<?php

namespace Src\Shared\Infrastructure\Services;

use Illuminate\Support\ServiceProvider as Service;

class DependencyServiceProvider extends Service
{
    /**
     * @var array
     */
    private array $dependencies;

    /**
     * @param array $dependencies
     * @return void
     */
    public function setDependency(array $dependencies): void
    {
        $this->dependencies = $dependencies;
    }

    /**
     * @return void
     */
    public function register(): void
    {
        foreach ($this->dependencies as $value) {
            $this->app
                ->when($value["useCase"])
                ->needs($value["contract"])
                ->give($value["repository"]);
        }
    }
}
