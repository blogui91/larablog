<?php namespace Modules\Tags\Src\Repositories;

interface TagRepositoryInterface {

	/**
	 * Returns a dataset compatible with data grid.
	 *
	 * @return \Modules\Tags\Src\Models\Tag
	 */
	public function grid();

	/**
	 * Returns all the tag entries.
	 *
	 * @return \Modules\Tags\Src\Models\Tag
	 */
	public function findAll();

	/**
	 * Returns a tag entry by its primary key.
	 *
	 * @param  int  $id
	 * @return \Modules\Tags\Src\Models\Tag
	 */
	public function find($id);

	/**
	 * Determines if the given tag is valid for creation.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForCreation(array $data);

	/**
	 * Determines if the given tag is valid for update.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForUpdate(array $data);

	/**
	 * Creates or updates the given tag.
	 *
	 * @param  int  $id
	 * @param  array  $input
	 * @return bool|array
	 */
	public function store($id, array $input);

	/**
	 * Creates a tag entry with the given data.
	 *
	 * @param  array  $data
	 * @return \Modules\Tags\Src\Models\Tag
	 */
	public function create(array $data);

	/**
	 * Updates the tag entry with the given data.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Modules\Tags\Src\Models\Tag
	 */
	public function update($id, array $data);

	/**
	 * Deletes the tag entry.
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
