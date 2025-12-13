<?php

namespace App\Http\Controllers\Site\Organization;

use App\Models\Contact\Contact;
use App\Http\Controllers\Controller;
use App\Repositories\Contact\ContactRepo;

class AboutUsController extends Controller
{

    protected $modelName = 'aboutus';
    protected $routeName = 'aboutus.index';
    protected $isDestroyingAllowed;
    protected $model;
    protected $repo;

    public function __construct(Contact $model, ContactRepo $repo)
    {
        $this->model = $model;
        $this->repo = $repo;
        $this->isDestroyingAllowed = true;
    }

    public function index()
    {
        DetectsUserEnvironment("About", 'View');
        return view('site.aboutus.index');
    }
}
