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
     * @var DepartmentRepositoryContract
     */
    protected $menu_permission;
    

    /**
     * @param DesignationRepositoryContract       $designation
     */
    public function __construct(DesignationRepositoryContract $designation,
        DepartmentRepositoryContract $department,
        MenuRepositoryContract $menu,
        MenuPermissionRepositoryContract $menu_permission
    )
    {
        $this->designation = $designation;
        $this->department = $department;
        $this->menu = $menu;
        $this->menu_permission = $menu_permission;
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
        
        $designation_id = $this->designation->create($request->all());
        $menu_permission = $this->menu_permission->create($request->all(),$designation_id);
       
        return redirect()->route('admin.designation')->withFlashSuccess('Record inserted successfully');
    }

    public function edit($id)
    {
        $designation = $this->designation->findOrThrowException( $id );
        $menu_permissions = $this->menu_permission->getDesignationPermission( $id );
        $departments = $this->department->getAllDepartment();
        $menus = $this->menu->getAllMenu();
        //print_r($designation);die;
        return view('Admin.designation.create', ["designation"=>$designation, "departments"=>$departments, 'menus' => $menus, 'menu_permissions'=>$menu_permissions]);
    }

    public function update(UpdateDesignationRequest $request)
    {
        $id = $request->id;//die;
        $designation = $this->designation->update($request->all() );
        $menu_permission = $this->menu_permission->update($request->all());

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
        $menu_permission = $this->menu_permission->delete($id);
        $destroyed = $this->designation->delete($id);
        
        $json['status'] = $destroyed ? 1 : 0;
        
        return response()->json($json);
        
    }

    


}