<?php
/*
namespace App\Http\Controllers;

use App\Models\Admin\AccountType\AccountType;
use App\Http\Request;
*/
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\AccountType\AccountTypeRepositoryContract;
use App\Http\Requests\Admin\AccountType\CreateAccountTypeRequest;
use App\Http\Requests\Admin\AccountType\StoreAccountTypeRequest;
use App\Http\Requests\Admin\AccountType\UpdateAccountTypeRequest;
use App\Http\Requests\Admin\AccountType\PermanentlyDeleteAccountTypeRequest;
use App\Http\Requests;

use Session;


class AccountTypeController extends Controller
{
    protected $accountType;
    public function __construct(AccountTypeRepositoryContract $accountType)
    {
        $this->accountType = $accountType;
    }
    public function index()
    {
        return view('Admin.accountType.accountType')
            ->withaccountTypes($this->accountType->getAccountTypePaginated(config('access.users.default_per_page'), 1));
    }
    public function create(CreateAccountTypeRequest $request)
    {
        return view('Admin.accountType.create');
    }

    public function store(StoreAccountTypeRequest $request)
    {
        $input = $request->all();
        $accountType = $this->accountType->create($request->all());

        return redirect()->route('admin.accountType')->withFlashSuccess('Record inserted successfully');
    }

    public function edit($id)
    {
        $accountType = $this->accountType->findOrThrowException( $id );
        //print_r($country);die;
        return view('Admin.accountType.create', ["accountType"=>$accountType]);
    }

    public function update(UpdateAccountTypeRequest $request)
    {
        $id = $request->id;//die;
        $this->accountType->update($request->all() );

        $response = array(
            'status' => 'success',
            'msg' => 'Record updated successfully',
        );
        return redirect()->route('admin.accountType')->withFlashSuccess('Record updated successfully');
    }

    public function delete(PermanentlyDeleteAccountTypeRequest $request)
    {
        $id = $request->id;
        $destroyed = $this->accountType->delete($id);
        $json['status'] = $destroyed ? 1 : 0;
        return response()->json($json);
    }
}
