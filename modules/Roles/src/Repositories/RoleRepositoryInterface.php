<?php namespace Modules\Roles\Src\Repositories;

interface RoleRepositoryInterface {

	/**
	 * Returns a dataset compatible with data grid.
	 *
	 * @return \Modules\Roles\Src\Models\Role
	 */
	public function grid();

	/**
	 * Returns all the users entries.
	 *
	 * @return \Modules\Roles\Src\Models\Role
	 */
	public function findAll();

	/**
	 * Returns a users entry by its primary key.
	 *
	 * @param  int  $id
	 * @return \Modules\Roles\Src\Models\Role
	 */
	public function find($id);

	/**
	 * Determines if the given users is valid for creation.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForCreation(array $data);

	/**
	 * Determines if the given users is valid for update.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForUpdate(array $data);

	/**
	 * Creates or updates the given users.
	 *
	 * @param  int  $id
	 * @param  array  $input
	 * @return bool|array
	 */
	public function store($id, array $input);

	/**
	 * Creates a users entry with the given data.
	 *
	 * @param  array  $data
	 * @return \Modules\Roles\Src\Models\Role
	 */
	public function create(array $data);

	/**
	 * Updates the users entry with the given data.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Modules\Roles\Src\Models\Role
	 */
	public function update($id, array $data);

	/**
	 * Deletes the users entry.
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
