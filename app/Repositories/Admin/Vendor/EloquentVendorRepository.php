<?php

namespace App\Repositories\Admin\Vendor;

use Carbon\Carbon;
use App\Models\Admin\Vendor\Vendor;
use DB;


/**
 * Class EloquentDesignationRepository
 * @package App\Repositories\Designation
 */
class EloquentVendorRepository implements VendorRepositoryContract
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
        /*if ($withRoles) {
            $user = Course::with('roles')->withTrashed()->find($id);
        } else {*/
            //$course = Course::withTrashed()->find($id);
            $vendor = Vendor::find($id);
        /*}*/

        if (!is_null($vendor)) {
            return $vendor;
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
    public function getVendorPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        /*return Vendor::orderBy($order_by, $sort)
            ->paginate($per_page);*/

            //countries, states, vendor_types, bank_account_detais

        return Vendor::leftJoin('countries', 'countries.id', '=', 'vendors.country_id')
            ->leftJoin('states', 'states.id', '=', 'vendors.state_id' )
            ->leftJoin('vendor_types', 'vendor_types.id', '=', 'vendors.vendor_type_id' )
            ->leftJoin('bank_account_details', 'bank_account_details.id', '=', 'vendors.bank_account_id' )
            ->select( 'vendors.*', 'countries.id as country_id', 'countries.name as country_name', 'states.id as state_id', 'states.name as state_name', 'vendor_types.id as vendor_type_id', 'vendor_types.vendor_type_name', 'bank_account_details.id as bank_account_detail_id', 'bank_account_details.bank_name', 'bank_account_details.account_no', 'bank_account_details.account_holder')
            ->get();
    }

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedVendorPaginated($per_page)
    {
        return Vendor::onlyTrashed()
            ->paginate($per_page);
    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllVendor($order_by = 'id', $sort = 'asc')
    {
        return Vendor::orderBy($order_by, $sort)
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
       
       $vendor = $this->createVendorStub($input);

        if ($vendor->save()) {
           
            $insertedId = $vendor->id;

            return $insertedId;
        }

        //throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param  $input
     * @return mixed
     */
    public function createVendorStub($input)
    {
        $vendor                    = new Vendor;
        $vendor->vendor_type_id              = $input['vendor_type_id'];
        $vendor->vendor_code                 = $input['vendor_code'];
        $vendor->first_name                  = $input['first_name'];
        $vendor->last_name                   = $input['last_name'];
        $vendor->email                       = $input['email'];
        $vendor->address_line1               = $input['address_line1'];
        $vendor->address_line2               = $input['address_line2'];
        $vendor->city                        = $input['city'];
        $vendor->state_id                    = $input['state_id'];
        $vendor->country_id                  = $input['country_id'];
        $vendor->zipcode                     = $input['zipcode'];
        $vendor->contact_number              = $input['contact_number'];
        $vendor->additional_contact_number   = $input['additional_contact_number'];
        $vendor->fax_no                      = $input['fax_no'];
        $vendor->discount_days               = $input['discount_days'];
        $vendor->discount_percentage         = $input['discount_percentage'];
        $vendor->term_days                   = $input['term_days'];
        $vendor->tax_id_no                   = $input['tax_id_no'];
        $vendor->taxable_amount              = $input['taxable_amount'];
        $vendor->consumer_user_tax           = $input['consumer_user_tax'];
        $vendor->balance_owed                = $input['balance_owed'];
        $vendor->date_opened                 = $input['date_opened'];
        $vendor->account_status              = isset($input['account_status']) ? 1 : 0;
        $vendor->bank_account_id             = $input['bank_account_id'];
        
        return $vendor;
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
        $vendor = $this->findOrThrowException($input['id']);
        //$this->checkUserByEmail($input, $user);
        //print_r($course);die;

        

        if ($vendor->update($input)) {
            $vendor->vendor_type_id              = $input['vendor_type_id'];
            $vendor->vendor_code                 = $input['vendor_code'];
            $vendor->first_name                  = $input['first_name'];
            $vendor->last_name                   = $input['last_name'];
            $vendor->email                       = $input['email'];
            $vendor->address_line1               = $input['address_line1'];
            $vendor->address_line2               = $input['address_line2'];
            $vendor->city                        = $input['city'];
            $vendor->state_id                    = $input['state_id'];
            $vendor->country_id                  = $input['country_id'];
            $vendor->zipcode                     = $input['zipcode'];
            $vendor->contact_number              = $input['contact_number'];
            $vendor->additional_contact_number   = $input['additional_contact_number'];
            $vendor->fax_no                      = $input['fax_no'];
            $vendor->discount_days               = $input['discount_days'];
            $vendor->discount_percentage         = $input['discount_percentage'];
            $vendor->term_days                   = $input['term_days'];
            $vendor->tax_id_no                   = $input['tax_id_no'];
            $vendor->taxable_amount              = $input['taxable_amount'];
            $vendor->consumer_user_tax           = $input['consumer_user_tax'];
            $vendor->balance_owed                = $input['balance_owed'];
            $vendor->date_opened                 = $input['date_opened'];
            $vendor->account_status              = isset($input['account_status']) ? 1 : 0;
            $vendor->bank_account_id             = $input['bank_account_id'];
            //echo $vendor->account_status;die;
            $vendor->save();

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
        $vendor = $this->findOrThrowException($id, true);

        try {
            $vendor->delete();
            return true;

        } catch (\Exception $e) {
            //print_r($e->getMessage());
           // throw new GeneralException($e->getMessage());
        }
    }

    public function chkUniqueEmail($email, $eid)
    {
        if ($eid != '') {
            $user = Vendor::where('email', $email)->where('id', '<>' , $eid)->get();
            //print_r(DB::getQueryLog());die;
        }else{
            $user = Vendor::where('email', $email)->get();    
        }
        
        return $user;
    }
    
}
