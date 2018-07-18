<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Vendor\VendorRepositoryContract;
use App\Repositories\Admin\Country\CountryRepositoryContract;
use App\Repositories\Admin\State\StateRepositoryContract;
use App\Repositories\Admin\VendorType\VendorTypeRepositoryContract;
use App\Repositories\Admin\BankAccount\BankAccountRepositoryContract;
use App\Http\Requests\Admin\Vendor\CreateVendorRequest;
use App\Http\Requests\Admin\Vendor\StoreVendorRequest;
use App\Http\Requests\Admin\Vendor\UpdateVendorRequest;
use App\Http\Requests\Admin\Vendor\PermanentlyDeleteVendorRequest;
use App\Http\Requests\Admin\Vendor\GetStateRequest;
use App\Http\Requests\Admin\Vendor\VendorEmailRequest;

use App\Http\Requests;




/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class VendorController extends Controller
{

    protected $vendor;
    protected $country;
    protected $state;
    protected $vendor_type;
    protected $bank_account;

    
    /**
     * @param UserRepositoryContract       $user
     */
    public function __construct(VendorRepositoryContract $vendor,
        CountryRepositoryContract $country,
        StateRepositoryContract $state,
        VendorTypeRepositoryContract $vendor_type,
        BankAccountRepositoryContract $bank_account
    )
    {
        $this->vendor = $vendor;
        $this->country = $country;
        $this->state = $state;
        $this->vendor_type = $vendor_type;
        $this->bank_account = $bank_account;
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
        return view('Admin.vendor.vendor')
            ->withVendors($this->vendor->getVendorPaginated(config('access.users.default_per_page'), 1));
    }

    /**
     * @param  CreateUserRequest $request
     * @return mixed
     */
    public function create(CreateVendorRequest $request)
    {
        return view('Admin.vendor.create')
            ->withCountries($this->country->getAllCountry())
            ->withStates($this->state->getAllState())
            ->withVendorTypes($this->vendor_type->getAllVendorType())
            ->withBankAccounts($this->bank_account->getAllBankAccount());
    }

     /**
     * @param  StoreUserRequest $request
     * @return mixed
     */
    public function store(StoreVendorRequest $request)
    {
        $vendor = $this->vendor->create($request->all());
        return redirect()->route('admin.vendor')->withFlashSuccess('Record inserted successfully');
    }

    public function edit($id)
    {
        $vendor = $this->vendor->findOrThrowException( $id );
        $countries = $this->country->getAllCountry();
        $states = $this->state->getAllState();
        $vendor_type = $this->vendor_type->getAllVendorType();
        $bank_account = $this->bank_account->getAllBankAccount();

        //print_r($designation);die;
        return view('Admin.vendor.create', ["vendor"=>$vendor, "countries"=>$countries, "states"=>$states, 'vendorTypes' => $vendor_type, 'bankAccounts' => $bank_account]);
    }

    public function update(UpdateVendorRequest $request)
    {
        $id = $request->id;//die;
        $vendor = $this->vendor->update($request->all() );

        $response = array(
            'status' => 'success',
            'msg' => 'Record updated successfully',
        );
        //return Response::json($response);
        //return response()->json($response);
        return redirect()->route('admin.vendor')->with('status','Record updated successfully');
    }

   
    /**
     * @param  $id
     * @param  PermanentlyDeleteUserRequest $request
     * @return mixed
     */
    //public function delete($id)
    public function delete(PermanentlyDeleteVendorRequest $request)
    {
        $id = $request->id;
        $destroyed = $this->vendor->delete($id);
        
        $json['status'] = $destroyed ? 1 : 0;
        
        return response()->json($json);
        
    }

    public function getStates($id, GetStateRequest $request)
    {
        //print_r($request->desg_id);
        //echo $id."dsd";
        $state = $this->state->getCountryState($id);

        

        $str = '';
        $str.='<select name="state_id" id="state_id" class="form-control select2" >';
        $str.='<option value="">Select State</option>';
        foreach ($state as $state) {
            if ( ($request->state_id != '') && ($request->state_id == $state->id) ) {
                $selected = 'selected="selected"';
            }else{
                $selected = '';
            }
            $str.='<option value="'.$state->id.'" '.$selected.' >'.$state->name.'</option>';
        }
        $str.='</select>';
        echo $str;
    }

    public function chkVendorEmail($email, VendorEmailRequest $request)
    {
        $vendor = $this->vendor->chkUniqueEmail($email, $request->edit_id);
        echo count($vendor);
        //print_r($user);
    }

    


}