<?php

namespace App\Http\Controllers\Site\Organization;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Contact\Contact;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use App\Repositories\Contact\ContactRepo;
use App\Http\Requests\Contact\StoreRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProductInquiryNotification;

class ContactController extends Controller
{

    protected $modelName = 'Contact';
    protected $routeName = 'contacts.index';
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
        DetectsUserEnvironment("Contact", 'View');

        return view('site.contact.index');
    }

    public function create()
    {
        //
    }

    public function store(StoreRequest $request)
    {
        try {
            $created = $this->repo->createContact($request);
            if ($created) {

                DetectsUserEnvironment("Contact", 'Create');
                // Notification::route('mail', 'm.fahath@mirnah.com')
                //     ->notify(new ProductInquiryNotification($request));

                Notification::route('mail', 'ariffakil@gmail.com')
                    ->notify(new ProductInquiryNotification($request));

                return  $this->response(
                    'Your message delivered successfully. We will get back to you shortly',
                    ['data' => $created],
                    true
                );
            }
        } catch (\Throwable $th) {
            return  $this->response($th->getMessage(), null, false);
        }
    }
}
