<?php

namespace App\Http\Controllers\Pages\Category;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Category\CategoryRepo;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use Intervention\Image\Laravel\Facades\Image;

class CategoryController extends Controller
{
    protected $modelName = 'Category';
    protected $routeName = 'product.index';
    protected $isDestroyingAllowed;
    protected $model;
    protected $repo;

    public function __construct(Category $model, CategoryRepo $repo)
    {
        $this->model = $model;
        $this->repo = $repo;
        $this->isDestroyingAllowed = true;

        // $this->middleware('userpermission:administration-role-view')->only('index');
    }

    public function index(Request $request)
    {
        $categories = Category::with('parentCategories')->get();

        // return $categories;

        return view('pages/category/index', [
            'categories' =>   $categories,
            'title' => $this->modelName,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StoreRequest $request)
    {
        try {
            $created =  $this->repo->createCategory($request);
            if ($created) {
                return  $this->response($this->modelName . ' created successfully', ['data' => $created], true);
            }
        } catch (\Throwable $th) {
            return  $this->response($th->getMessage(), null, false);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(UpdateRequest $request, Category $category)
    {
        try {
            $updated = $this->repo->updateCategory($request, $category);

            if ($updated) {
                logActivity($this->modelName . ' Update',  $this->modelName . " ID " . $category->id, 'Update');
                return  $this->response($this->modelName . ' updated successfully', ['data' => $category], true);
            }
        } catch (\Throwable $th) {
            throw $th;
            return  $this->response($th->getMessage(), null, false);
        }
    }

    public function destroy(Category $category)
    {
        try {
            $deleted = $category->delete();
            if ($deleted) {

                logActivity($this->modelName . ' Delete', "Category ID " . $category->id, 'Delete');

                return $this->response($this->modelName . ' successfully deleted.', $deleted, true);
            } else {
                return $this->response($this->modelName . ' cannot deleted.', null, false);
            }
        } catch (\Throwable $th) {
            return $this->response($th, null, false);
        }
    }
}
