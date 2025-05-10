<?php

namespace App\Repositories;

use App\Contracts\RepositoryInterface;  // Importing the repository interface for defining the contract
use Illuminate\Database\Eloquent\Model; // Importing the Eloquent Model class to work with database records
use Spatie\QueryBuilder\QueryBuilder;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     * The model instance that this repository will manage.
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * The model instance that the repository will interact with.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve all records from the database for the model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     * Returns a collection of all records for the model.
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Find a record by its ID.
     *
     * @param int $id
     * The ID of the record to find.
     * 
     * @return \Illuminate\Database\Eloquent\Model
     * Returns the found model instance, or throws a `ModelNotFoundException` if not found.
     */
    public function find($id, ...$relations)
    {
        return $this->model->with($relations)->findOrFail($id); // This will throw an exception if not found.
    }

    /**
     * Create a new record in the database for the model.
     *
     * @param array $data
     * The data to create the new record with.
     * 
     * @return \Illuminate\Database\Eloquent\Model
     * Returns the newly created model instance.
     */
    public function create(array $data)
    {
        return $this->model->create($data); // This uses the model's create method to insert data.
    }

    /**
     * Update an existing record in the database.
     *
     * @param array $data
     * The new data to update the record with.
     * @param int $id
     * The ID of the record to update.
     * 
     * @return \Illuminate\Database\Eloquent\Model
     * Returns the updated model instance.
     */
    public function update(array $data, $id)
    {
        // Find the existing record by ID
        $model = $this->find($id);

        // Update the model with the provided data
        $model->update($data);

        // Return the updated model
        return $model;
    }

    /**
     * Delete a record from the database.
     *
     * @param int $id
     * The ID of the record to delete.
     * 
     * @return bool
     * Returns `true` if the deletion was successful, `false` otherwise.
     */
    public function delete($id)
    {
        // Find the record to delete
        $model = $this->find($id);

        // Delete the record
        return $model->delete(); // This will delete the model from the database.
    }

    protected function query(): QueryBuilder
    {
        return QueryBuilder::for($this->model);
    }
}
