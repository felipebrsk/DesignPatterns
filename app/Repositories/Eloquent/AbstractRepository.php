<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\ForbiddenException;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
    public function store(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param array $data
     */
    public function update(array $data, $id)
    {
        $model = $this->model->find($id);

        if ($model->id != Auth::id()) {
            throw new ForbiddenException();
        }

        $model->update($data);

        return $model;
    }

    protected function resolveModel()
    {
        return app($this->model);
    }
}