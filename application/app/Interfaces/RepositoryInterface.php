<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * Retrieve all records.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function all(): Collection;

    /**
     * Create a new instance of the model with the given data.
     *
     * @param array $data The data to create the model with.
     * @return Model|null The created model instance or null on failure.
     */
    public static function create(array $data): ?Model;

    /**
     * Find a model by its primary key.
     *
     * @param int $id The primary key of the model to find.
     * @return Model|null The found model instance or null if not found.
     */
    public static function find(int $id): ?Model;

    /**
     * Update a model instance with the given data.
     *
     * @param array $data The data to update the model with.
     * @param int $id The ID of the model to update.
     * @return Model|null The updated model instance or null if the update fails.
     */
    public static function update(array $data, int $id): ?Model;

    /**
     * Delete a record by its ID.
     *
     * @param int $id The ID of the record to delete.
     * @return int The number of records deleted.
     */
    public static function delete(int $id): int;

    /**
     * Load and return the model instance.
     *
     * @return Model The loaded model instance.
     */
    public static function loadModel(): Model;
}