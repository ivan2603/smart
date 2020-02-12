<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Repositories\Admin\MainRepository;
use App\Repositories\Admin\OrderRepository;
use App\Repositories\Admin\ProductRepository;
use Illuminate\Http\Request;
use MetaTag;

class MainController extends AdminBaseController
{
	private $orderRepository;
	private $productRepository;

	public function __construct()
	{
		parent::__construct();
		$this->orderRepository   = app(OrderRepository::class);
		$this->productRepository = app(ProductRepository::class);
	}

	public function index() {

		$pagination = 4;

		$lastOrders   = $this->orderRepository->getLastOrders(6);
		$lastProducts = $this->productRepository->getLastProducts($pagination);

		$countOrders     = MainRepository::getCountOrders() ?? '0';
		$countUsers      = MainRepository::getCountUsers() ?? '0';
		$countProducts   = MainRepository::getCountProducts() ?? '0';
		$countCategories = MainRepository::getCountCategories() ?? '0';

		MetaTag::setTags(['title' => 'Dashboard']);
		return view('blog.admin.main.index', compact('countOrders', 'countUsers', 'countProducts', 'countCategories',
			'lastProducts', 'lastOrders'));
	}
}
