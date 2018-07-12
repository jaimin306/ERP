<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Designation\DesignationRepositoryContract;
use App\Repositories\Admin\Department\DepartmentRepositoryContract;
use App\Repositories\Admin\MenuPermission\MenuPermissionRepositoryContract;
use App\Repositories\Admin\Menu\MenuRepositoryContract;
use App\Http\Requests\Admin\Designation\CreateDesignationRequest;
use App\Http\Requests\Admin\Designation\StoreDesignationRequest;
use App\Http\Requests\Admin\Designation\UpdateDesignationRequest;
use App\Http\Requests\Admin\Designation\PermanentlyDeleteDesignationRequest;
use App\Http\Requests;




/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class DesignationController extends Controller
{

    /**
     * @var DesignationRepositoryContract
     */
    protected $designation;

    /**
     * @var DepartmentRepositoryContract
     */
    protected $department;

    /**
     * @var DepartmentRepositoryContract
     */
    protected $menu;
    

    /**
     * @param DesignationRepositoryContract       $designation
     */
    public function __construct(DesignationRepositoryContract $designation,
        DepartmentRepositoryContract $department,
        MenuRepositoryContract $menu
    )
    {
        $this->designation = $designation;
        $this->department = $department;
        $this->menu = $menu;
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
        return view('Admin.designation.designation')
            ->withDesignations($this->designation->getDesignationPaginated(config('access.users.default_per_page'), 1));
    }

    /**
     * @param  CreateUserRequest $request
     * @return mixed
     */
    public function create(CreateDesignationRequest $request)
    {
        return view('Admin.designation.create')
            ->withDepartments($this->department->getAllDepartment())
            ->withMenus($this->menu->getAllMenu());
    }

     /**
     * @param  StoreUserRequest $request
     * @return mixed
     */
    public function store(StoreDesignationRequest $request)
    {
        
        $input = $request->all();
        $designation = $this->designation->create($request->all());
        $designation = $this->designation->create($request->all());

        return redirect()->route('admin.designation')->withFlashSuccess('Record inserted successfully');
    }

    public function edit($id)
    {
        //echo "string";die;
        $designation = $this->designation->findOrThrowException( $id );
        $departments = $this->department->getAllDepartment();
        //print_r($designation);die;
        return view('Admin.designation.create', ["designation"=>$designation, "departments"=>$departments]);
    }

    public function update(UpdateDesignationRequest $request)
    {
        $id = $request->id;//die;
        $this->designation->update($request->all() );

        $response = array(
            'status' => 'success',
            'msg' => 'Record updated successfully',
        );
        //return Response::json($response);
        //return response()->json($response);
        return redirect()->route('admin.designation')->withFlashSuccess('Record updated successfully');
    }

   
    /**
     * @param  $id
     * @param  PermanentlyDeleteUserRequest $request
     * @return mixed
     */
    //public function delete($id)
    public function delete(PermanentlyDeleteDesignationRequest $request)
    {
        $id = $request->id;
        
        $destroyed = $this->designation->delete($id);
        $json['status'] = $destroyed ? 1 : 0;
        
        return response()->json($json);
        
    }

    


}