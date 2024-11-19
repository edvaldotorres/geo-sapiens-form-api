<?php

namespace App\Repositories\Eloquent;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    protected static $model;

    /**
     * Retrieve all records from the model ordered by 'id' in descending order.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function all(): Collection
    {
        return static::loadModel()::orderBy('id', 'desc')->get();
    }

    /**
     * Create a new model instance with the given data.
     *
     * @param array $data The data to be used for creating the model instance.
     * @return Model|null The created model instance or null if creation fails.
     */
    public static function create(array $data): ?Model
    {
        return static::loadModel()::query()->create($data);
    }

    /**
     * Find a model by its primary key.
     *
     * @param int $id The primary key of the model to find.
     * @return Model|null The found model instance or null if not found.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If no model is found.
     */
    public static function find(int $id): ?Model
    {
        return static::loadModel()::findOrFail($id);
    }

    /**
     * Updates a model with the given data.
     *
     * @param array $data The data to update the model with.
     * @param int $id The ID of the model to update.
     * @return Model|null The updated model, or null if the model was not found.
     */
    public static function update(array $data, int $id): ?Model
    {
        $model = static::find($id);
        if ($model) {
            $model->update($data);
        }
        return $model;
    }

    /**
     * Deletes a model by its ID.
     *
     * @param int $id The ID of the model to delete.
     * @return int Returns 1 if the model was deleted, 0 if the model was not found.
     */
    public static function delete(int $id): int
    {
        $model = static::find($id);
        return $model ? $model->delete() : 0;
    }

    /**
     * Load and return an instance of the model.
     *
     * This method uses the Laravel `app()` helper to resolve and return an instance
     * of the model class specified by the static `$model` property.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function loadModel(): Model
    {
        return app(static::$model);
    }
}