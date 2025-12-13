<?php

namespace App\Http\Controllers\Site\Product;

use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use App\Models\Product\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::search($request)->get();

        // return $products;
        DetectsUserEnvironment("Product", 'View');

        return view('site.product.products', [
            'products' => $products,
            'categories' => $products,
        ]);
    }

    public function productByCategory(Request $request, $category)
    {
        $categoryModel = Category::where('slug', $category)->first();

        if (!$categoryModel->parent_id) {
            // If it's a parent category, get products from its subcategories
            // $subCategoryIds = $categoryModel->clone()->where('parent_id', $categoryModel->id)->pluck('id');

            $subCategoryIds = $this->extractAllIds($categoryModel->clone()->with('subcategories')
                ->where('parent_id', $categoryModel->id)->get());
            $products =   Product::whereIn('category_id', $subCategoryIds)->get();
        } else {
            $products = Product::whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            })->get();
        }

        DetectsUserEnvironment("Product By $category", 'View');

        // return [
        //     $subCategoryIds,
        //     $categoryModel,
        //     $categoryModel->clone()->with('subcategories')->where('parent_id', $categoryModel->id)->get(),
        // ];

        return view('site.product.products-by-category', [
            'products' => $products,
            'category' => $categoryModel,
        ]);
    }

    public  function extractAllIds($categories)
    {
        $ids = [];

        foreach ($categories as $category) {
            $ids[] = $category['id'];

            if (!empty($category['subcategories'])) {
                $ids = array_merge($ids, $this->extractAllIds($category['subcategories']));
            }
        }

        return $ids;
    }

    public function show(string $id)
    {
        $product = Product::whereId($id)->with('gallery', 'category', 'attributes', 'files', 'videos')->first();

        DetectsUserEnvironment("Product Show $product->name", 'View');

        // return $product;

        return view('site.product.show', [
            'product' => $product,
        ]);
    }

    public function productByCategory1(Request $request, $category)
    {
        // $ids = Category::whereSlug($category)->pluck('id');
        // return  $products = Product::whereIn('category_id', $ids)->get();
        // $category;

        $products = Product::whereHas('category', function ($query) use ($category) {
            $query->where('slug', $category);
        })->get();

        return view('site.product.Products-by-category', [
            'products' => $products,
            'categories' => $products,
        ]);

        // $products = Product::with('category') // Eager load the category relationship
        //     ->whereHas('category', function ($query) use ($category) {
        //         $query->where('slug', $category);
        //     })->get();

        return $products;
    }
}
