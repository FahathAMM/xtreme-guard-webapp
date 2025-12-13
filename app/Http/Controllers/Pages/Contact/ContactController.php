<?php

namespace App\Http\Controllers\Pages\Contact;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Contact\Contact;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Repositories\Contact\ContactRepo;
use App\Http\Requests\Contact\StoreRequest;

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

    public function index(Request $request)
    {
        // return $this->model->query()->get();

        if ($request->ajax()) {

            $permissions = [
                'isDelete' => false,
                'isEdit' => false,
                'isView' => true,
                'isPrint' => false
            ];

            $model = $this->model->query();
            // return $this->model->query()->get();

            logActivity('Contact Master', 'Contact Master', 'View');

            return Datatables::of($model)->addIndexColumn()
                ->addColumn('action', function ($model) use ($permissions) {
                    return actionBtns(
                        $model->id,
                        'contacts.edit',
                        'admin/contacts',
                        $model->name,
                        $permissions
                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.contact.index', [
            'title' =>   $this->modelName,
        ]);
    }

    public function store(StoreRequest $request)
    {
        try {
            $created =  $this->repo->createContact($request);
            if ($created) {
                return  $this->response(
                    'Your message has been delivered successfully. We will get back to you shortly',
                    ['data' => $created],
                    true
                );
                // return  $this->response($this->modelName . ' created successfully', ['data' => $created], true);
            }
        } catch (\Throwable $th) {
            return  $this->response($th->getMessage(), null, false);
        }
    }

    public function show(Contact $contact)
    {
        return view('pages.contact.show', [
            'title' =>   $this->modelName,
            'contact' =>   $contact,
        ]);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Contact $contact)
    {
        try {
            $deleted = $contact->delete();
            if ($deleted) {

                logActivity($this->modelName . ' Delete', "Contact ID " . $contact->id, 'Delete');

                return $this->response($this->modelName . ' successfully deleted.', $deleted, true);
            } else {
                return $this->response($this->modelName . ' cannot deleted.', null, false);
            }
        } catch (\Throwable $th) {
            return $this->response($th, null, false);
        }
    }
}
