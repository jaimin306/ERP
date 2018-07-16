<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\User\UserRepositoryContract;
use App\Repositories\Admin\Designation\DesignationRepositoryContract;
use App\Repositories\Admin\Department\DepartmentRepositoryContract;
use App\Http\Requests\Admin\User\CreateUserRequest;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Requests\Admin\User\PermanentlyDeleteUserRequest;
use App\Http\Requests\Admin\User\GetDesignationRequest;
use App\Http\Requests;




/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class UserController extends Controller
{

    /**
     * @var DesignationRepositoryContract
     */
    protected $user;

    /**
     * @var DesignationRepositoryContract
     */
    protected $designation;

    /**
     * @var DepartmentRepositoryContract
     */
    protected $department;

    
    /**
     * @param UserRepositoryContract       $user
     */
    public function __construct(UserRepositoryContract $user,
        DesignationRepositoryContract $designation,
        DepartmentRepositoryContract $department
    )
    {
        $this->user = $user;
        $this->designation = $designation;
        $this->department = $department;
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
        return view('Admin.user.user')
            ->withUsers($this->user->getUserPaginated(config('access.users.default_per_page'), 1));
    }

    /**
     * @param  CreateUserRequest $request
     * @return mixed
     */
    public function create(CreateUserRequest $request)
    {
        return view('Admin.user.create')
            ->withDesignations($this->designation->getAllDesignation())
            ->withDepartments($this->department->getAllDepartment());
    }

     /**
     * @param  StoreUserRequest $request
     * @return mixed
     */
    public function store(StoreUserRequest $request)
    {
        $input = $request->all();
        
        $user = $this->user->create($request->all());
       
        return redirect()->route('admin.user')->withFlashSuccess('Record inserted successfully');
    }

    public function edit($id)
    {
        $user = $this->user->findOrThrowException( $id );
        $designations = $this->designation->getAllDesignation();
        $departments = $this->department->getAllDepartment();

        //print_r($designation);die;
        return view('Admin.user.create', ["user"=>$user, "designations"=>$designations, "departments"=>$departments]);
    }

    public function update(UpdateUserRequest $request)
    {
        $id = $request->id;//die;
        $user = $this->user->update($request->all() );

        $response = array(
            'status' => 'success',
            'msg' => 'Record updated successfully',
        );
        //return Response::json($response);
        //return response()->json($response);
        return redirect()->route('admin.user')->with('status','Record updated successfully');
    }

   
    /**
     * @param  $id
     * @param  PermanentlyDeleteUserRequest $request
     * @return mixed
     */
    //public function delete($id)
    public function delete(PermanentlyDeleteUserRequest $request)
    {
        $id = $request->id;
        $destroyed = $this->user->delete($id);
        
        $json['status'] = $destroyed ? 1 : 0;
        
        return response()->json($json);
        
    }

    public function getDesignation($id, GetDesignationRequest $request)
    {
        //print_r($request->desg_id);
        //echo $id."dsd";
        $designation = $this->designation->getDepartmentDesignation($id);

        if ($request->desg_id != '') {
            $selected = 'selected=selected';
        }else{
            $selected = '';
        }

        $str = '';
        $str.='<select name="designation_id" id="designation_id" class="form-control" >';
        $str.='<option value="">Select Designation</option>';
        foreach ($designation as $designation) {
            $str.='<option value="'.$designation->id.'" '.$selected.' >'.$designation->designation_name.'</option>';
        }
        $str.='</select>';
        echo $str;
    }

    public function chkUserEmail($email)
    {
        $user = $this->user->chkUniqueUserEmail($email);
        echo count($user);
        //print_r($user);
    }

    


}