<?php

namespace App\Repositories\Admin\Designation;

use App\Models\Admin\Designation\Designation;
use DB;


/**
 * Class EloquentDesignationRepository
 * @package App\Repositories\Designation
 */
class EloquentDesignationRepository implements DesignationRepositoryContract
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
            $designation = Designation::find($id);
        /*}*/

        if (!is_null($designation)) {
            return $designation;
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
    public function getDesignationPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        /*return Designation::where('status', $status)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);*/
        /*return Designation::orderBy($order_by, $sort)
            ->paginate($per_page);*/

        return Designation::leftJoin('departments', 'departments.id', '=', 'designations.department_id')
            ->select( 'designations.designation_name', 'designations.id as designation_id', 'departments.department_name', 'departments.id as department_id', 'designations.department_id as designation_department_id')
            ->get();
    }

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedDesignationPaginated($per_page)
    {
        return Designation::onlyTrashed()
            ->paginate($per_page);
    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllDesignation($order_by = 'id', $sort = 'asc')
    {
        return Designation::orderBy($order_by, $sort)
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
       $designation = $this->createDesignationStub($input);
       //print_r($course);die;


        if ($designation->save()) {
           
            $insertedId = $designation->id;

            return $insertedId;
        }

        //throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param  $input
     * @return mixed
     */
    public function createDesignationStub($input)
    {
        
        $designation                    = new Designation;
        $designation->designation_name              = $input['designation_name'];
        $designation->department_id              = $input['department_id'];
        
        //print_r($Designation);die;
        
        return $designation;
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
        $designation = $this->findOrThrowException($input['id']);
        //$this->checkUserByEmail($input, $user);
        //print_r($course);die;

        

        if ($designation->update($input)) {
            //For whatever reason this just wont work in the above call, so a second is needed for now
            $designation->designation_name              = $input['designation_name'];
            $designation->department_id              = $input['department_id'];
            
            $designation->save();

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
        //print_r($id);echo "designa string";die;

        $designation = $this->findOrThrowException($id, true);

        try {
            //echo "string";die;
            $designation->delete();
            //echo "string";die;
            return true;

        } catch (\Exception $e) {
            print_r($e->getMessage());
           // throw new GeneralException($e->getMessage());
        }
    }

    public function getDepartmentDesignation($dept_id)
    {
        $desg = Designation::where('department_id', $dept_id)->get();
        return $desg;
        //print_r($desg);die;
            /*->orderBy($order_by, $sort)
            ->paginate($per_page);*/
    }
    
}
