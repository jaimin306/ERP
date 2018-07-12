<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Department\DepartmentRepositoryContract;
use App\Http\Requests\Admin\Department\CreateDepartmentRequest;
use App\Http\Requests\Admin\Department\StoreDepartmentRequest;
use App\Http\Requests\Admin\Department\UpdateDepartmentRequest;
use App\Http\Requests\Admin\Department\PermanentlyDeleteDepartmentRequest;
use App\Http\Requests;
use Session;


class DepartmentController extends Controller
{

    /**
     * @var DepartmentRepositoryContract
     */
    protected $department;

     /**
     * @param DepartmentRepositoryContract       $department
     */
    public function __construct(DepartmentRepositoryContract $department)
    {
        $this->department = $department;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('Admin.department.department')
            ->withDepartments($this->department->getDepartmentPaginated(config('access.users.default_per_page'), 1));
    }

    /**
     * @param  CreateUserRequest $request
     * @return mixed
     */
    public function create(CreateDepartmentRequest $request)
    {
        return view('Admin.department.create');
    }

     /**
     * @param  StoreUserRequest $request
     * @return mixed
     */
    public function store(StoreDepartmentRequest $request)
    {
        
        $input = $request->all();
        $department = $this->department->create($request->all());

        return redirect()->route('admin.department')->withFlashSuccess('Record inserted successfully');
        //return redirect()->route('admin.department')->with('status', 'New book was added');
    }

    public function edit($id)
    {
        //echo "string";die;
        $department = $this->department->findOrThrowException( $id );
        //print_r($department);die;
        return view('Admin.department.create', ["department"=>$department]);
    }

    public function update(UpdateDepartmentRequest $request)
    {
        $id = $request->id;//die;
        $this->department->update($request->all() );

        $response = array(
            'status' => 'success',
            'msg' => 'Record updated successfully',
        );
        //return Response::json($response);
        //return response()->json($response);
        return redirect()->route('admin.department')->withFlashSuccess('Record updated successfully');
    }

    public function destroy()
    {
        $id=$_POST['id'];//die;

        $destroyed = $department->delete();

        $json['status'] = $destroyed ? 1 : 0;
        //echo json_encode($json);
        //return Response::json($json_encode);
        return response()->json($json);
    }

    /**
     * @param  $id
     * @param  PermanentlyDeleteUserRequest $request
     * @return mixed
     */
    //public function delete($id)
    public function delete(PermanentlyDeleteDepartmentRequest $request)
    {
        //echo "dsf";print_r($request);die;
        $id = $request->id;//die;
        
        $destroyed = $this->department->delete($id);
        $json['status'] = $destroyed ? 1 : 0;
        //echo json_encode($json);
        //return Response::json($json_encode);
        return response()->json($json);
        //return redirect()->back()->withFlashSuccess('Record deleted successfully');
        //return redirect()->route('admin.department')->withFlashSuccess('Record deleted successfully');
    }
}
