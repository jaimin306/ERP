<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\BankAccount\BankAccountRepositoryContract;
use App\Repositories\Admin\AccountType\AccountTypeRepositoryContract;
use App\Http\Requests\Admin\BankAccount\CreateBankAccountRequest;
use App\Http\Requests\Admin\BankAccount\StoreBankAccountRequest;
use App\Http\Requests\Admin\BankAccount\UpdateBankAccountRequest;
use App\Http\Requests\Admin\BankAccount\PermanentlyDeleteBankAccountRequest;
use App\Http\Requests;
use Illuminate\Http\Request;



/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class BankAccountController extends Controller
{

	/**
     * @var CourseRepositoryContract
     */
    protected $bankAccount;

    /**
     * @var CourseRepositoryContract
     */
    protected $accountType;
    

    /**
     * @param CourseRepositoryContract       $courses
     */
    public function __construct(BankAccountRepositoryContract $bankAccount, AccountTypeRepositoryContract $accountType)
    {
        $this->bankAccount = $bankAccount;
        $this->accountType = $accountType;
    }


    /**
     * @return mixed
     */
    /*public function index()
    {
        return view('backend.access.index')
            ->withUsers($this->users->getUsersPaginated(config('access.users.default_per_page'), 1));
    }*/
    public function index()
    {
        return view('Admin.bankAccount.bankAccount')->withbankAccounts($this->bankAccount->getBankAccountPaginated(config('access.users.default_per_page'), 1));
    }

    /**
     * @param  CreateUserRequest $request
     * @return mixed
     */
    public function create(CreateBankAccountRequest $request)
    {
        /*$a = $this->accountType->getAllAccountType();
        echo "<pre>";print_r($a);die;*/
        return view('Admin.bankAccount.create')
            ->withaccountTypes($this->accountType->getAllAccountType());
    }

     /**
     * @param  StoreUserRequest $request
     * @return mixed
     */
    public function store(StoreBankAccountRequest $request)
    {
    	
		$input = $request->all();
        $bankAccount = $this->bankAccount->create($request->all());

        return redirect()->route('admin.bankAccount')->with('status', 'New record was added');
    }

    public function edit($id)
    {
        //echo $id;
        $bankAccount = $this->bankAccount->findOrThrowException( $id );
        //echo '<pre>';print_r($bankAccount);die;
        $accountType = $this->accountType->getAllAccountType();
        //print_r($state);die;
        return view('Admin.bankAccount.create', ["bankAccount"=>$bankAccount, "accountTypes"=>$accountType]);
    }

    public function update(UpdateBankAccountRequest $request)
    {
        $id = $request->id;//die;
        $this->bankAccount->update($request->all() );

    	$response = array(
            'status' => 'success',
            'msg' => 'Record updated successfully',
        );
        //return Response::json($response);
        //return response()->json($response);
        return redirect()->route('admin.bankAccount')->withFlashSuccess('Record updated successfully');
    }

    
    /**
     * @param  $id
     * @param  PermanentlyDeleteUserRequest $request
     * @return mixed
     */
    
    public function delete(Request $request)
    {
        $id = $request->id;//die;
        
        $destroyed = $this->bankAccount->delete($id);
        $json['status'] = $destroyed ? 1 : 0;
        return response()->json($json);
        
    }

    


}