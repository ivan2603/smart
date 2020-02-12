<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 11.02.20
 * Time: 15:03
 */

namespace App\Repositories;
/**
 * Class CoreRepository
 * @package app\Repositories
 */
abstract class CoreRepository
{
	/**
	 * @var \Illuminate\Contracts\Foundation\Application|mixed
	 */
	protected $model;

	/**
	 * CoreRepository constructor.
	 */
	public function __construct()
	{
		$this->model = app($this->getModelClass());
	}

	/**
	 * @return mixed
	 */
	abstract protected function getModelClass();


	/**
	 * @return \Illuminate\Contracts\Foundation\Application|mixed
	 */
	protected function startConditions()
	{
		return clone $this->model;
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function getId($id)
	{
		return $this->startConditions()->find($id);
	}

	public function getRequestId($get = true, $id = 'id')
	{
		if ($get) {
			$data = $_GET;
		} else {
			$data = $_POST;
		}
		$id = (int)$data[$id] ?? null;

		if (!$id) {
			throw new \Exception('Check id', 404);
		}
	}

}