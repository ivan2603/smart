<?php

namespace App\Http\Controllers\Blog\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Blog\Admin\AdminBaseController;
use MetaTag;

class MainController extends AdminBaseController
{
	public function index() {

		MetaTag::setTags(['title' => 'Dashboard']);
		return view('blog.admin.main.index');
	}
}
