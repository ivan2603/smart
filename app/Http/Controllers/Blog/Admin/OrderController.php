<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\Admin\Order;
use App\Repositories\Admin\MainRepository;
use App\Repositories\Admin\OrderRepository;
use Illuminate\Http\Request;

/**
 * Class OrderController
 * @package App\Http\Controllers\Blog\Admin
 */
class OrderController extends AdminBaseController
{
	/**
	 * @var OrderRepository|\Illuminate\Contracts\Foundation\Application|mixed
	 */
	private $orderRepository;

	/**
	 * OrderController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->orderRepository = app(OrderRepository::class);
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = 10;
	    $countOrders = MainRepository::getCountOrders();
	    $orders = $this->orderRepository->getLastOrders($pagination);
	    \MetaTag::setTags(['title' => 'Order list']);
		return view('blog.admin.order.index', compact('countOrders', 'orders', 'pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.admin.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	    $item = $this->orderRepository->getId($id);
	    \MetaTag::setTags(['title' => "Refund order ID {$item->id}"]);

	    if(!empty($item)) {
		    $orderProductsRefund = $this->orderRepository->getAllOrderProductsId($item->id);
	    }
	    $order = $this->orderRepository->getOrder($item->id);
	    return view('blog.admin.order.refund', compact('orderProductsRefund', 'order', 'id'));
    }

	/**
	 * @param $id
	 */
	protected function restore($id) {

	    $this->orderRepository->restoreOrder($id);
    }

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	private function checkOrderStatus($id) {

	    return $this->orderRepository->checkStatus($id);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return string
     */
    public function edit($id = null)
    {
	    $status = $this->checkOrderStatus($id);
	    if ($status == 2) {
		    $this->restore($id);
		    return redirect()->route('blog.admin.orders.index')
			    ->with(['success' => "Order $id restored"]);
	    }
	    $item = $this->orderRepository->getId($id);

	    \MetaTag::setTags(['title' => "Edit order ID {$item->id}"]);
	    if (!empty($item)) {
		    $order = $this->orderRepository->getOrder($item->id);

	    }

	    if ($order) {
		    $orderProducts = $this->orderRepository->getAllOrderProductsId($item->id);

	    }

		return view('blog.admin.order.edit', compact('item', 'order', 'orderProducts'));
    }

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function change($id) {

	    $result = $this->orderRepository->changeStatus($id);

	    if ($result) {
		    return redirect()->route('blog.admin.orders.edit', $id)
			    ->with(['success' => 'Status Changed']);
	    } else {
		    return back()->withErrors(['message' => 'Error change status']);
	    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $res = $this->orderRepository->moveOrderToArchive($id);

	    if ($res) {
		    $result = Order::destroy($id);
		    if ($result) {
		        return redirect()->route('blog.admin.orders.index')
			        ->with(['success' => "Order $id moved to archive"]);
		    } else {
			    return back()->withErrors(['message' => "Order $id not moved to archive"]);
		    }
	    } else {
		    return back()->withErrors(['message' => 'Error']);
	    }
    }
}
