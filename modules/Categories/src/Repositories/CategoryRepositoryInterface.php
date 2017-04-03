<?php namespace Modules\Categories\Src\Repositories;

interface CategoryRepositoryInterface {

	/**
	 * Returns a dataset compatible with data grid.
	 *
	 * @return \Modules\Categories\Src\Models\Category
	 */
	public function grid();

	/**
	 * Returns all the category entries.
	 *
	 * @return \Modules\Categories\Src\Models\Category
	 */
	public function findAll();

	/**
	 * Returns a category entry by its primary key.
	 *
	 * @param  int  $id
	 * @return \Modules\Categories\Src\Models\Category
	 */
	public function find($id);

	/**
	 * Determines if the given category is valid for creation.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForCreation(array $data);

	/**
	 * Determines if the given category is valid for update.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForUpdate(array $data);

	/**
	 * Creates or updates the given category.
	 *
	 * @param  int  $id
	 * @param  array  $input
	 * @return bool|array
	 */
	public function store($id, array $input);

	/**
	 * Creates a category entry with the given data.
	 *
	 * @param  array  $data
	 * @return \Modules\Categories\Src\Models\Category
	 */
	public function create(array $data);

	/**
	 * Updates the category entry with the given data.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Modules\Categories\Src\Models\Category
	 */
	public function update($id, array $data);

	/**
	 * Deletes the category entry.
	 *
	 * @param  int  $id
	 * @return bool
	 */
	public function delete($id);


	/**
	 * Prepara date before validation.
	 *
	 * @param array $input
	 * @return array

	 */
	public function prepareData(array $input);

}
