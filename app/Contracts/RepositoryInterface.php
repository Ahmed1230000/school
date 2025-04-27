<?php

namespace App\Contracts; 

interface RepositoryInterface
{
    /**
     * Interface for the Repository pattern.
     * This interface defines the basic CRUD operations that can be performed on a model.
     * Any class implementing this interface should define these methods.
     */

    /**
     * Retrieve all records from the model.
     * 
     * @return \Illuminate\Database\Eloquent\Collection 
     *       This method should return a collection of records from the database.
     */
    public function all();

    /**
     * Find a single record by its ID.
     * 
     * @param int $id  The ID of the record we want to find.
     * @return \Illuminate\Database\Eloquent\Model  The record that was found.
     * 
     * If the record is not found, you could use something like `findOrFail` to throw an exception.
     */
    public function find(int $id);

    /**
     * Create a new record in the database.
     * 
     * @param array $data The data to create the new record with.
     * @return \Illuminate\Database\Eloquent\Model  The newly created record.
     * 
     * This method should take an array of data and use the model's `create` method to insert the new record.
     */
    public function create(array $data);

    /**
     * Update an existing record in the database.
     * 
     * @param array $data The data to update the record with.
     * @param int $id The ID of the record to be updated.
     * @return \Illuminate\Database\Eloquent\Model  The updated record.
     * 
     * This method should find the record by ID and then update it with the provided data.
     */
    public function update(array $data, int $id);

    /**
     * Delete a record from the database by its ID.
     * 
     * @param int $id The ID of the record to delete.
     * @return bool  Returns true if the deletion was successful, otherwise false.
     * 
     * This method should find the record by ID and delete it.
     */
    public function delete(int $id);
}
