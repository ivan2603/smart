<?php

namespace App\Repositories\Admin;

use App\Repositories\CoreRepository;
use App\Models\Admin\Order as Model;
use DB;

/**
 * Class OrderRepository
 * @package App\Repositories\Admin
 */
class OrderRepository extends CoreRepository
{
	/**
	 * OrderRepository constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @return mixed
	 */
	protected function getModelClass()
	{
		return Model::class;
	}

	/**
	 * @param $pagination
	 *
	 * @return mixed
	 */
	public function getLastOrders($pagination) {

		$orders = $this->startConditions()->withTrashed()
			->join('users', 'orders.user_id', '=', 'users.id')
			->join('order_products', 'order_products.order_id', '=', 'orders.id')
			->select(DB::raw('ROUND(SUM(order_products.price), 2)AS sum'), 'orders.id', 'orders.user_id', 'orders.status', 'orders.created_at',
				'orders.updated_at', 'orders.currency', 'users.name')
			->groupBy('orders.id')
			->orderBy('orders.status')
			->orderBy('orders.id')
			->toBase()
			->paginate($pagination);
		return $orders;


	}
}