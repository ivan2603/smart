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
			->select(DB::raw('ROUND(SUM(order_products.price), 2)AS sum'), 'orders.id',
				'orders.user_id', 'orders.status', 'orders.created_at',
				'orders.updated_at', 'orders.currency', 'users.name')
			->groupBy('orders.id')
			->orderBy('orders.status')
			->orderBy('orders.id')
			->toBase()
			->paginate($pagination);
		return $orders;
	}

	public function getOrder($orderId)
	{
		$order = $this->startConditions()->withTrashed()
			->join('users', 'orders.user_id', '=', 'users.id')
			->join('order_products', 'order_products.order_id', '=', 'orders.id')
			->select('orders.*', 'users.name', DB::raw('ROUND(SUM(order_products.price), 2)AS sum'))
			->where('orders.id', $orderId)
			->groupBy('orders.id')
			->orderBy('orders.status')
			->orderBy('orders.id')
			->first();
		return $order;
	}

	public function getAllOrderProductsId($orderId) {

		$orderProducts = DB::table('order_products')
			->where('order_id', $orderId)
			->get();
		return $orderProducts;
	}

	public function changeStatus($id) {

		$item = $this->getId($id);

		if ($item) {
			$item->status = request()->has('status') ? request()->status : '0';
			$result = $item->update();
		}
		return $result;
	}

	public function moveOrderToArchive($id) {

		$item = $this->getId($id);

		$item->status = '2';
		$result = $item->update();

		return $result;
	}

	public function restoreOrder($id) {

		$model = $this->getModelClass();

		$restored = $model::withTrashed()
			->where('id', $id)
			->restore();

		if ($restored) {
			$item = $this->getId($id);
			$item->status = '1';
			$item->update();
		}

	}

	public function checkStatus($id) {

		$result = DB::select("SELECT status FROM orders WHERE id = $id");
		foreach ($result as $key => $value) {
			$status = $value->status;
		}
		return $status;
	}
}