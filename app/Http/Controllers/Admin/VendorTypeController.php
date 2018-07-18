<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\VendorType\VendorTypeRepositoryContract;
use App\Http\Requests\Admin\VendorType\CreateVendorTypeRequest;
use App\Http\Requests\Admin\VendorType\StoreVendorTypeRequest;
use App\Http\Requests\Admin\VendorType\UpdateVendorTypeRequest;
use App\Http\Requests\Admin\VendorType\DeleteVendorTypeRequest;
use App\Http\Requests;
use Session;




/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class VendorTypeController extends Controller
{

    /**
     * @var CourseRepositoryContract
     */
    protected $vendor_type;
    

    /**
     * @param CourseRepositoryContract       $courses
     */
    public function __construct(VendorTypeRepositoryContract $vendor_type)
    {
        $this->vendor_type = $vendor_type;
    }


    /**
     * @return mixed
     */
    public function index()
    {
        return view('Admin.vendorType.vendor_type')
            ->withVendorTypes($this->vendor_type->getVendorTypePaginated(config('access.users.default_per_page'), 1));
    }

    /**
     * @param  CreateUserRequest $request
     * @return mixed
     */
    public function create(CreateVendorTypeRequest $request)
    {
        return view('Admin.vendorType.create');
    }

     /**
     * @param  StoreUserRequest $request
     * @return mixed
     */
    public function store(StoreVendorTypeRequest $request)
    {
        
        $input = $request->all();
        $vendor_type = $this->vendor_type->create($request->all());
        Session::flash('flash_message','Office successfully added.'); //<--FLASH MESSAGE
        //return redirect()->route('admin.country')->withFlashSuccess('Record inserted successfully');
        return redirect()->route('admin.vendorType');
        //->with('status', 'New book was added');
    }

    public function edit($id)
    {
        //echo "string";die;
        $vendor_type = $this->vendor_type->findOrThrowException( $id );
        //print_r($country);die;
        return view('Admin.vendorType.create', ["vendor_type"=>$vendor_type]);
    }

    public function update(UpdateVendorTypeRequest $request)
    {
        $id = $request->id;//die;
        $this->vendor_type->update($request->all() );

        $response = array(
            'status' => 'success',
            'msg' => 'Record updated successfully',
        );
        //return Response::json($response);
        //return response()->json($response);
        //return redirect()->route('admin.country')->withFlashSuccess('Record updated successfully');
        return redirect()->route('admin.vendorType')->with('success','Product updated successfully');
        
    }

    /**
     * @param  $id
     * @param  PermanentlyDeleteUserRequest $request
     * @return mixed
     */
    //public function delete($id)
    public function delete(DeleteVendorTypeRequest $request)
    {
        $id = $request->id;
        $destroyed = $this->vendor_type->delete($id);
        $json['status'] = $destroyed ? 1 : 0;
        return response()->json($json);
        
    }

    


}