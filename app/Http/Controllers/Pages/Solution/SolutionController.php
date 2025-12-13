<?php

namespace App\Http\Controllers\Pages\Solution;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use Yajra\DataTables\DataTables;
use App\Models\Category\Category;
use App\Models\Solution\Solution;
use App\Http\Controllers\Controller;
use App\Models\Product\ProductImage;
use App\Models\Product\ProductAttachment;
use App\Models\Solution\SolutionsContent;
use App\Repositories\Solution\SolutionRepo;
use App\Http\Requests\Solution\StoreRequest;
use App\Http\Requests\Solution\UpdateRequest;

class SolutionController extends Controller
{
    protected $modelName = 'Solution';
    protected $routeName = 'solution.index';
    protected $isDestroyingAllowed;
    protected $model;
    protected $repo;

    public function __construct(Solution $model, SolutionRepo $repo)
    {
        $this->model = $model;
        $this->repo = $repo;
        $this->isDestroyingAllowed = true;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $permissions = [
                'isDelete' => true,
                'isEdit'   => true,
                'isView'   => false,
                'isPrint'  => false
            ];

            $solution = $this->model->query();
            // return $this->model->query()->get();

            logActivity('User Master', 'User Master', 'View');

            return Datatables::of($solution)->addIndexColumn()
                ->addColumn('action', function ($solution) use ($permissions) {
                    return actionBtns(
                        $solution->id,
                        'solution.edit',
                        'admin/solution',
                        $solution->name,
                        $permissions
                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.solution.index', [
            'title' =>   $this->modelName,
        ]);
    }

    public function create()
    {
        $solutionTypes = getSolutionForHeader();

        $additional = [
            ["id" => "software", "name" => "Software"]
        ];

        $solutionTypes = [...$solutionTypes, ...$additional];

        return view('pages.solution.create', [
            'title' =>   $this->modelName,
            'solutionTypes' =>   $solutionTypes,
        ]);
    }

    public function edit(Solution $solution)
    {
        $solutionTypes = getSolutionForHeader();

        $additional = [
            ["id" => "software", "name" => "Software"]
        ];

        $solutionTypes = [...$solutionTypes, ...$additional];

        $solution = $solution->load('contents');

        // return $solution;

        return view('pages.solution.edit', [
            'title' =>   $this->modelName,
            'solution' =>   $solution,
            'solutionTypes' =>   $solutionTypes,
        ]);
    }

    public function store(StoreRequest $request)
    {
        try {
            $created =  $this->repo->createSolution($request);
            if ($created) {
                return  $this->response($this->modelName . ' created successfully', ['data' => $created], true);
            }
        } catch (\Throwable $th) {
            return $this->response($th->getMessage(), null, false);
        }
    }

    public function update(UpdateRequest $request, Solution $solution)
    {
        try {
            $updated = $this->repo->updateSolution($request, $solution);

            if ($updated) {
                logActivity($this->modelName . ' Update',  $this->modelName . " ID " . $solution->id, 'Update');
                return  $this->response($this->modelName . ' updated successfully', ['data' => $solution], true);
            }
        } catch (\Throwable $th) {
            throw $th;
            return  $this->response($th->getMessage(), null, false);
        }
    }

    public function destroy(Solution $solution)
    {
        try {
            $deleted = $solution->delete();
            // $deleted = true;
            if ($deleted) {

                logActivity($this->modelName . ' Delete', "Solution ID " . $solution->id, 'Delete');

                return $this->response($this->modelName . ' successfully deleted.', $deleted, true);
            } else {
                return $this->response($this->modelName . ' cannot deleted.', null, false);
            }
        } catch (\Throwable $th) {
            return $this->response($th, null, false);
        }
    }

    public function changeOrderById($id, $value)
    {
        $updated = SolutionsContent::where('id', $id)->update(['cont_orderby' => $value]);

        if ($updated) {
            logActivity('Content Order Update', " Content Order ID " . $id, 'Update');
            return response()->json(['data' => $id, 'status' => true, 'msg' => 'Order changed successfully']);
        } else {
            return $this->response(['data' => $id, 'status' => false, 'msg' => 'cannot change'], null, false);
        }
    }

    public function deleteSolutionFile($id, $key)
    {
        $model = Solution::find($id);
        $data = $model->file;

        unset($data['a']);

        $model->file = $data;
        $model->save();

        return redirect()->back()->with('success', $this->modelName . ' file successfully deleted.');
    }

    public function deleteSolutionImg($id)
    {
        $deleted = SolutionsContent::where('id', $id)->delete();

        return redirect()->back()->with('success', $this->modelName . ' image successfully deleted.');
    }


    public function deleteSolutionImgOld($path, $img, $solution)
    {
        $model = Solution::find($solution);
        $data = $model->banner_img;

        $value = "solution/$img";

        $key = array_search($value, $data);
        unset($data[$key]);

        $model->banner_img = $data;
        $model->save();

        return redirect()->back()->with('success', $this->modelName . ' image successfully deleted.');
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
