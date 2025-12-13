<?php

namespace App\Http\Controllers\Site\Solution;

use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Solution\Solution;

class SolutionController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::search($request)->get();

        // return $products;

        return view('site.product.products', [
            'products' => $products,
            'categories' => $products,
        ]);
    }

    public function solutionByType(Request $request, $type)
    {
        $solutions = Solution::with('contents')->where('solution_type', $type)->get();

        DetectsUserEnvironment("Solution By $type", 'View');
        // return $solutions;

        return view('site.solution.solution-by-type', [
            'solutions' => $solutions,
        ]);
    }

    public function show(string $id)
    {
        $solution = Solution::with('contents')->findOrFail($id);

        $previous = Solution::where('id', '<', $solution->id)->orderBy('id', 'desc')->first();

        $next = Solution::where('id', '>', $solution->id)->orderBy('id', 'asc')->first();

        $related = Solution::where('solution_type', $solution->solution_type)->where('id', '!=', $solution->id)->latest()
            ->limit(5)->get();

        // return  [
        //     'solution' => $solution,
        //     'previous' => $previous,
        //     'next' => $next,
        // ];

        // return $solution;
        // return $related;

        return view('site.solution.show', [
            'solution' => $solution,
            'previous' => $previous,
            'next' => $next,
            'related' => $related,
        ]);
    }
}
