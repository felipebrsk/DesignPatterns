<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Collection;

abstract class AbstractRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    /**
     *  Display a listing of the resource. Collection.
     * 
     *  @return \Illuminate\Support\Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    protected function resolveModel()
    {
        return app($this->model);
    }
}