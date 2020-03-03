<?php

namespace App\Repositories\Admin;

use App\Repositories\CoreRepository;
use App\Models\Admin\Category as Model;
use Menu as CategoriesMenu;

/**
 * Class CategoryRepository
 * @package App\Repositories\Admin
 */
class CategoryRepository extends CoreRepository
{

	/**
	 * CategoryRepository constructor.
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
	 * @param $categories
	 *
	 * @return \Lavary\Menu\Builder
	 */
	public function buildMenu($categories) {

		$builder = CategoriesMenu::make('Navigation', function ($menu) use ($categories) {

			foreach ($categories as $item) {
				if ($item->parent_id == 0) {
					$menu->add($item->title, $item->id)
						->id($item->id);
				} else {
					if ($menu->find($item->parent_id)) {
						$menu->find($item->parent_id)
							->add($item->title, $item->id)
							->id($item->id);
					}
				}
			}
		});

		return $builder;
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function checkChildren($id) {
		$children = $this->startConditions()
			->where('parent_id', $id)
			->count();

		return $children;
	}

	/**
	 * @param $id
	 *
	 * @return int
	 */
	public function hasProducts($id) {

		$products = \DB::table('products')
			->where('category_id', $id)
			->count();

		return $products;
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function deleteCategory($id) {

		$delete = $this->startConditions()
			->find($id)
			->forceDelete();
		return $delete;
	}

	/**
	 * @return mixed
	 */
	public function getCategories() {

		$columns = implode(',', [
			'id',
			'parent_id',
			'title',
			'CONCAT (id, ". ", title ) AS category_title',
		]);

		$result = $this->startConditions()
			->selectRaw($columns)
			->toBase()
			->get();
		return $result;
	}


	/**
	 * @param $name
	 * @param $parent_id
	 *
	 * @return mixed
	 */
	public function isUniqueName($name, $parent_id) {
		$exists = $this->startConditions()
			->where('title', '=', $name)
			->where('parent_id', '=', $parent_id)
			->exists();
		return $exists;
	}

}