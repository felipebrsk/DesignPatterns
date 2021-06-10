<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function find(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param array $data
     */
    public function update(array $data, $id)
    {
        //
    }

    protected function resolveModel()
    {
        return app($this->model);
    }
}