<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call('RolesTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('UserRolesTableSeeder');
		$this->call('AttributeGroupsSeeder');
		$this->call('AttributeProductsSeeder');
		$this->call('AttributeValuesSeeder');
		$this->call('BrandsSeeder');
		$this->call('CategoriesSeeder');
		$this->call('CurrenciesSeeder');
		$this->call('GalleriesSeeder');
		$this->call('ProductsSeeder');
		$this->call('RelatedProductsSeeder');
		$this->call('OrdersSeeder');
		$this->call('AdminOrderProductsSeeder');


	}
}
