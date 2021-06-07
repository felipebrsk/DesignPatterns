<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

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

    /**
     *  Store a newly created resource in storage.
     * 
     *  @param array $data;
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    protected function resolveModel()
    {
        return app($this->model);
    }
}