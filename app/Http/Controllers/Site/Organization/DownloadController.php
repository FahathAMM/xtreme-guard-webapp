<?php

namespace App\Http\Controllers\Site\Organization;

use Illuminate\Http\Request;
use App\Models\Contact\Contact;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use App\Models\Product\ProductAttachment;
use App\Repositories\Contact\ContactRepo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    protected $modelName = 'Download';
    protected $routeName = 'download.index';
    protected $isDestroyingAllowed;
    protected $model;
    protected $repo;

    public function __construct(Contact $model, ContactRepo $repo)
    {
        $this->model = $model;
        $this->repo = $repo;
        $this->isDestroyingAllowed = true;
    }


    public function downloadFile(ProductAttachment $file)
    {
        // return $file;
        $path = $file->path;

        DetectsUserEnvironment("Download $path", 'Download');

        return Storage::download("public/$path");
    }

    public function index(Request $request)
    {
        // $attachments = Product::with('files')->get(['id', 'name', 'file_category'])->groupBy('file_category');

        $attachments = Product::search($request)->with('files')
            ->get(['id', 'name', 'file_category'])->groupBy('file_category');

        // $attachments = Product::search($request)
        //     ->with('files')
        //     ->get(['id', 'name', 'file_category'])
        //     ->groupBy('file_category');

        // $page = request()->get('page', 1);
        // $perPage = 10;
        // $paginated = new LengthAwarePaginator(
        //     $attachments->forPage($page, $perPage),
        //     $attachments->count(),
        //     $perPage,
        //     $page,
        //     ['path' => request()->url(), 'query' => request()->query()]
        // );

        // return $attachments;
        DetectsUserEnvironment("Download", 'View');

        return view('site.download.index', [
            'modelName' => $this->modelName,
            'routeName' => $this->routeName,
            'attachments' => $attachments,
        ]);
    }
}
