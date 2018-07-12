<?php

namespace App\Repositories\Admin\MenuPermission;

use App\Models\Admin\MenuPermission;
use DB;


/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class EloquentMenuPermissionRepository implements MenuPermissionRepositoryContract
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
            $menu_permission = MenuPermission::find($id);
        /*}*/

        if (!is_null($menu_permission)) {
            return $menu_permission;
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
    public function getMenuPermissionPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        /*return Country::where('status', $status)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);*/
        return MenuPermission::orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedMenuPermissionPaginated($per_page)
    {
        return MenuPermission::onlyTrashed()
            ->paginate($per_page);
    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllMenuPermission($order_by = 'id', $sort = 'asc')
    {
        return MenuPermission::orderBy($order_by, $sort)
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
       $menu_permission = $this->createMenuPermissionStub($input);
       //print_r($course);die;


        if ($menu_permission->save()) {
           
            $insertedId = $menu_permission->id;

            return $insertedId;
        }

        //throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param  $input
     * @return mixed
     */
    public function createMenuPermissionStub($input)
    {
        
        $menu_permission                    = new MenuPermission;
        $menu_permission->menu_id           = $input['menu_id'];
        $menu_permission->designation_id    = $input['designation_id'];
        $menu_permission->create            = $input['create'];
        $menu_permission->edit              = $input['edit'];
        $menu_permission->delete            = $input['delete'];
        $menu_permission->view              = $input['view'];
        //$country->status            = isset($input['status']) ? 1 : 0;
        //print_r($country);die;
        
        return $menu_permission;
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
        $menu_permission = $this->findOrThrowException($input['id']);
        //$this->checkUserByEmail($input, $user);
        //print_r($course);die;

        

        if ($menu_permission->update($input)) {
            //For whatever reason this just wont work in the above call, so a second is needed for now
            $menu_permission->menu_id              = $input['menu_id'];
            $menu_permission->designation_id       = $input['designation_id'];
            $menu_permission->create               = $input['create'];
            $menu_permission->edit                 = $input['edit'];
            $menu_permission->delete               = $input['delete'];
            $menu_permission->view                 = $input['view'];

            $menu_permission->save();

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

        $menu_permission = $this->findOrThrowException($id, true);

        try {

            //$course->forceDelete();
            $menu_permission->delete();
            return true;

        } catch (\Exception $e) {
           // throw new GeneralException($e->getMessage());
        }
    }
    
}
