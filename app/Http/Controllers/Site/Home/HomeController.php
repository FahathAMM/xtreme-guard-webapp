<?php

namespace App\Http\Controllers\Site\Home;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class HomeController extends Controller
{
    protected $modelName = 'Home';
    protected $routeName = 'user.index';
    protected $isDestroyingAllowed;
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
        $this->isDestroyingAllowed = true;

        // administration-logged-users-tracking-view
    }

    public function index(Request $request)
    {
        $products = Product::orderBy('created_at', 'desc')->take(9)->with('category')->get();
        $categories = getParentCategories();
        DetectsUserEnvironment('Home Page', 'View');

        return view('site.home.index', [
            'categories' => $categories,
            'products' => $products,
            'title' => $this->modelName,
        ]);
    }
}
