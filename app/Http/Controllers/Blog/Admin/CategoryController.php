<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Admin\Category;
use App\Repositories\Admin\MainRepository;
use App\Repositories\Admin\CategoryRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Blog\Admin
 */
class CategoryController extends AdminBaseController
{
	/**
	 * @var CategoryRepository|\Illuminate\Contracts\Foundation\Application|mixed
	 */
	private $categoryRepository;

	/**
	 * CategoryController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->categoryRepository = app(CategoryRepository::class);
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		\MetaTag::setTags(['title' => 'Category list']);
	    $categories = Category::all();
	    $menu = $this->categoryRepository->buildMenu($categories);
	    return view('blog.admin.category.index', ['menu' => $menu]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $entity = new Category();
	    $categories = $this->categoryRepository->getCategories();

	    \MetaTag::setTags(['title' => 'Create category']);
        return view('blog.admin.category.create', [
        	'categories' => Category::with('children')->where('parent_id', 0)->get(),
	        'delimiter' => '-',
	        'entity' => $entity,
        ]);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CategoryUpdateRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(CategoryUpdateRequest $request)
    {
	    if ($this->categoryRepository->isUniqueName($request->title,
		    $request->parent_id)) {
		    return back()->withErrors(['msg' => 'You cannot create category named as parent category'])
			    ->withInput();
	    }

	    $data = $request->input();
	    $entity = new Category();
	    $entity->fill($data)->save();

	    if ($entity) {
		    return redirect()->route('blog.admin.categories.create', [$entity->id])
			    ->with(['success' => "Category created successfully."]);
	    } else {
		    return back()->withErrors(['msg' => 'Error create category'])
			    ->withInput();
	    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $entity = $this->categoryRepository->getId($id);
	    \MetaTag::setTags(['title' => "Edit category ID $id"]);
	    return view('blog.admin.category.edit', [
		    'categories' => Category::with('children')->where('parent_id', 0)->get(),
		    'delimiter' => '-',
		    'entity' => $entity,
	    ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
	    $entity = $this->categoryRepository->getId($id);
        if (!$entity) {
	        return back()->withErrors(['msg' => 'Entity category ID not found'])
		        ->withInput();
        }
        $result = $entity->update($request->all());

	    if ($result) {
		    return redirect()->route('blog.admin.categories.edit', $entity->id)
			    ->with(['success' => "Category updated successfully!"]);
	    } else {
		    return back()->withErrors(['msg' => 'Error updating category!'])
			    ->withInput();
	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

	/**
	 * @param $id
	 *
	 * @return RedirectResponse
	 */
	public function delete($id) {


	    if ($this->categoryRepository->checkChildren($id)) {
		    return back()->withErrors(['msg' => 'You cannot delete this category!']);
	    }

	    if ($this->categoryRepository->hasProducts($id)) {
		    return back()->withErrors(['msg' => 'You cannot delete this category! Category has products!']);
	    }

	    if ($this->categoryRepository->deleteCategory($id)) {
		    return redirect()->route('blog.admin.categories.index')
			    ->with(['success' => "Category with ID $id, was deleted."]);
	    } else {
		    return back()->withErrors(['msg' => 'Error deleting category!']);
	    }



    }
}
