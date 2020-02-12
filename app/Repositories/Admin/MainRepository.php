<?php

namespace App\Repositories\Admin;

use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MainRepository
 * @package app\Repositories\Admin
 */
class MainRepository extends CoreRepository
{

	/**
	 * @return mixed
	 */
	protected function getModelClass()
	{
		return Model::class;
	}

	/**
	 * @return int
	 */
	public static function getCountOrders()
	 {
		 $countOrders = \DB::table('orders')
			->where('status', '0')
			->get()
			->count();
		 return $countOrders;
	 }

	/**
	 * @return int
	 */
	public static function getCountUsers()
	 {
		 $countUsers = \DB::table('users')
			 ->get()
			 ->count();
		 return $countUsers;
	 }

	/**
	 * @return int
	 */
	public static function getCountProducts()
	 {
		 $countProducts = \DB::table('products')
			 ->get()
			 ->count();
		 return $countProducts;
	 }

	/**
	 * @return int
	 */
	public static function getCountCategories()
	 {
		 $countCategories = \DB::table('categories')
			 ->get()
			 ->count();
		 return $countCategories;
	 }



}