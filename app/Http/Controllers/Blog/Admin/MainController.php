<?php

namespace App\Http\Controllers\Blog\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Blog\Admin\AdminBaseController;

class MainController extends AdminBaseController
{
	public function index() {

		return view('blog.admin.main.index');
	}
}
