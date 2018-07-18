<?php

namespace App\Repositories\Admin\BankAccount;

use App\Models\Admin\BankAccount\BankAccount;
use DB;

class EloquentBankAccountRepository implements BankAccountRepositoryContract
{
    

    /**
     * @param RoleRepositoryContract $role
     * @param FrontendUserRepositoryContract $user
     */
    public function __construct(
        
    )
    {
        
    }

    /**
     * @param  $id
     * @param  bool               $withRoles
     * @throws GeneralException
     * @return mixed
     */
    public function findOrThrowException($id, $withRoles = false)
    {
        $bankAccount = BankAccount::find($id);
 
        if (!is_null($bankAccount)) {
            return $bankAccount;
        }

        //throw new GeneralException(trans('exceptions.backend.access.users.not_found'));
    }

    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @param  int         $status
     * @return mixed
     */
    public function getBankAccountPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return BankAccount::leftJoin('account_types', 'account_types.id', '=', 'bank_account_details.account_type_id')->select('bank_account_details.bank_name as bank_name', 'bank_account_details.id as bank_account_id','bank_account_details.account_holder', 'bank_account_details.account_type_id as type_id', 'account_types.account_type as account_type_name', 'account_types.id as account_type_id')->get();

    }

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedBankAccountPaginated($per_page)
    {
        return BankAccount::onlyTrashed()
            ->paginate($per_page);
    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllBankAccount($order_by = 'id', $sort = 'asc')
    {
        return BankAccount::orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param  $input
     * @param  $roles
     * @param  $permissions
     * @throws GeneralException
     * @throws UserNeedsRolesException
     * @return bool
     */
    public function create($input)
    {

       //echo "<pre>";print_r($input);die;

       //throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
       $bankAccount = $this->createBankAccountStub($input);
       //print_r($course);die;


        if ($bankAccount->save()) {
           
            $insertedId = $bankAccount->id;

            return $insertedId;
        }

        //throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param  $input
     * @return mixed
     */
    public function createBankAccountStub($input)
    {
        
        $bankAccount                    = new BankAccount;
        $bankAccount->account_type_id   = $input['account_type_id'];
        $bankAccount->bank_name         = $input['bank_name'];
        $bankAccount->account_no        = $input['account_no'];
        $bankAccount->account_holder    = $input['account_holder'];
        $bankAccount->branch_name       = $input['branch_name'];
        $bankAccount->micr_code         = $input['micr_code'];
        $bankAccount->ifsc_code         = $input['ifsc_code'];
        $bankAccount->bank_address      = $input['bank_address'];
        
        return $bankAccount;
    }

    /**
     * @param $id
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     */
    public function update($input)
    {
        $bankAccount = $this->findOrThrowException($input['id']);
        //$this->checkUserByEmail($input, $user);
        //print_r($course);die;

        

        if ($bankAccount->update($input)) {
            //For whatever reason this just wont work in the above call, so a second is needed for now
            $bankAccount->account_type_id   = $input['account_type_id'];
            $bankAccount->bank_name         = $input['bank_name'];
            $bankAccount->account_no        = $input['account_no'];
            $bankAccount->account_holder    = $input['account_holder'];
            $bankAccount->branch_name       = $input['branch_name'];
            $bankAccount->micr_code         = $input['micr_code'];
            $bankAccount->ifsc_code         = $input['ifsc_code'];
            $bankAccount->bank_address      = $input['bank_address'];
            
            $bankAccount->save();

            return true;
        }

        //throw new GeneralException(trans('exceptions.backend.access.users.update_error'));
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return boolean|null
     */
    public function delete($id)
    {
        //print_r($id);echo "string";die;

        $bankAccount = $this->findOrThrowException($id, true);

        try {

            //$course->forceDelete();
            $bankAccount->delete();
            return true;

        } catch (\Exception $e) {
           // throw new GeneralException($e->getMessage());
        }
    }
    
}
