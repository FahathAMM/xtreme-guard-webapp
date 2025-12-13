<?php

namespace App\Http\Controllers\Pages\Product;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use Yajra\DataTables\DataTables;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use App\Models\Product\ProductImage;
use App\Repositories\Product\ProductRepo;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product\ProductAttachment;

class ProductController extends Controller
{
    protected $modelName = 'Product';
    protected $routeName = 'product.index';
    protected $isDestroyingAllowed;
    protected $model;
    protected $repo;

    public function __construct(Product $model, ProductRepo $repo)
    {
        $this->model = $model;
        $this->repo = $repo;
        $this->isDestroyingAllowed = true;
    }

    public function index1(Request $request)
    {
        if ($request->ajax()) {

            $permissions = [
                'isDelete' => true,
                'isEdit' => true,
                'isView' => true,
                'isPrint' => false
            ];

            $user = $this->model->query();
            // return $this->model->query()->get();
            logActivity('User Master', 'User Master', 'View');

            return Datatables::of($user)->addIndexColumn()
                ->addColumn('action', function ($user) use ($permissions) {
                    return actionBtns(
                        $user->id,
                        'user.edit',
                        'administration/user',
                        $user->username,
                        $permissions
                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.product.index', [
            'title' =>   $this->modelName,
        ]);
    }

    public function index(Request $request)
    {
        // return $this->model->query()->get();

        if ($request->ajax()) {

            $permissions = [
                'isDelete' => true,
                'isEdit' => true,
                'isView' => false,
                'isPrint' => false
            ];

            $product = $this->model->query();
            // return $this->model->query()->get();

            logActivity('User Master', 'User Master', 'View');

            return Datatables::of($product)->addIndexColumn()
                ->addColumn('action', function ($product) use ($permissions) {
                    return actionBtns(
                        $product->id,
                        'products.edit',
                        'admin/products',
                        $product->name,
                        $permissions
                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.product.index', [
            'title' =>   $this->modelName,
        ]);
    }

    public function create()
    {
        return view('pages.product.create', [
            'categories' => Category::get(['id', 'name', 'slug']),
            'title' =>   $this->modelName,
        ]);
    }

    public function edit(Product $product)
    {
        // return $product->load('images', 'attributes', 'videos', 'files');
        return view('pages.product.edit', [
            'categories' => Category::get(['id', 'name', 'slug']),
            'title' =>   $this->modelName,
            'product' =>   $product->load('images', 'attributes', 'videos', 'files'),
        ]);
    }

    public function store(StoreRequest $request)
    {
        try {
            $created =  $this->repo->createProduct($request);
            if ($created) {
                return  $this->response($this->modelName . ' created successfully', ['data' => $created], true);
            }
        } catch (\Throwable $th) {
            return  $this->response($th->getMessage(), null, false);
        }
    }

    public function update(UpdateRequest $request, Product $product)
    {
        try {
            $updated = $this->repo->updateProduct($request, $product);

            if ($updated) {
                logActivity($this->modelName . ' Update',  $this->modelName . " ID " . $product->id, 'Update');
                return  $this->response($this->modelName . ' updated successfully', ['data' => $product], true);
            }
        } catch (\Throwable $th) {
            throw $th;
            return  $this->response($th->getMessage(), null, false);
        }
    }

    public function destroy(Product $product)
    {
        try {
            $deleted = $product->delete();
            // $deleted = true;
            if ($deleted) {

                logActivity($this->modelName . ' Delete', "Product ID " . $product->id, 'Delete');

                return $this->response($this->modelName . ' successfully deleted.', $deleted, true);
            } else {
                return $this->response($this->modelName . ' cannot deleted.', null, false);
            }
        } catch (\Throwable $th) {
            return $this->response($th, null, false);
        }
    }

    public function deleteProductImg($id)
    {
        try {
            $deleted = ProductImage::find($id)->delete();

            if ($deleted) {

                logActivity($this->modelName . ' Delete', "Product Img ID " . $id, 'Delete');

                return redirect()->back()->with('success', $this->modelName . ' image successfully deleted.');

                // return $this->response($this->modelName . ' successfully deleted.', $deleted, true);
            } else {
                return $this->response($this->modelName . ' cannot deleted.', null, false);
            }
        } catch (\Throwable $th) {
            return $this->response($th, null, false);
        }
    }

    public function deleteProductFile($id)
    {
        try {

            $deleted = ProductAttachment::find($id)->delete();

            if ($deleted) {

                logActivity($this->modelName . ' Delete', " Product File ID " . $id, 'Delete');

                return redirect()->back()->with('success', $this->modelName . ' file successfully deleted.');
            } else {
                return $this->response($this->modelName . ' cannot deleted.', null, false);
            }
        } catch (\Throwable $th) {
            return $this->response($th, null, false);
        }
    }
}
