<?php

namespace App\Repositories\Admin\Department;

use App\Models\Admin\Department\Department;
use DB;


/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class EloquentDepartmentRepository implements DepartmentRepositoryContract
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
            $department = Department::find($id);
        /*}*/

        if (!is_null($department)) {
            return $department;
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
    public function getDepartmentPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        /*return Department::where('status', $status)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);*/
        return Department::orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedDepartmentPaginated($per_page)
    {
        return Department::onlyTrashed()
            ->paginate($per_page);
    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllDepartment($order_by = 'id', $sort = 'asc')
    {
        return Department::orderBy($order_by, $sort)
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
       $department = $this->createDepartmentStub($input);
       //print_r($course);die;


        if ($department->save()) {
           
            $insertedId = $department->id;

            return $insertedId;
        }

        //throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param  $input
     * @return mixed
     */
    public function createDepartmentStub($input)
    {
        
        $department                    = new Department;
        $department->name              = $input['name'];
        //print_r($department);die;
        
        return $department;
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
        $department = $this->findOrThrowException($input['id']);
        //$this->checkUserByEmail($input, $user);
        //print_r($course);die;

        

        if ($department->update($input)) {
            //For whatever reason this just wont work in the above call, so a second is needed for now
            $department->name              = $input['name'];

            $department->save();

            //$this->checkUserRolesCount($roles);
            //$this->flushRoles($roles, $user);
            //$this->flushPermissions($permissions, $user);

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

        $department = $this->findOrThrowException($id, true);

        try {

            //$course->forceDelete();
            $department->delete();
            return true;

        } catch (\Exception $e) {
           // throw new GeneralException($e->getMessage());
        }
    }
    
}
