<?php

namespace App\Repositories\Admin\MenuPermission;

use App\Models\Admin\MenuPermission\MenuPermission;
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
    public function create($input,$designation_id)
    {
       //echo "<pre>";print_r($input);die;

       //throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
       //$menu_permission = $this->createMenuPermissionStub($input, $designation);
       //print_r($menu_permission);die;

        for ($i=1; $i <= count($input['menu_id']) ; $i++) {

            if ( isset($input['menu_id'][$i]) ) {
                //echo $input['chk_create'][$i]." - Create - <br>";
                $input['menu'][$i] = $input['menu_id'][$i];
            }else{
                $input['menu'][$i] = '0';
            }

            if ( isset($input['chk_create'][$i]) ) {
                //echo $input['chk_create'][$i]." - Create - <br>";
                $input['create'][$i] = $input['chk_create'][$i];
            }else{
                $input['create'][$i] = '0';
            }

            if ( isset($input['chk_edit'][$i]) ) {
                //echo $input['chk_create'][$i]." - Create - <br>";
                $input['edit'][$i] = $input['chk_edit'][$i];
            }else{
                $input['edit'][$i] = '0';
            }

            if ( isset($input['chk_delete'][$i]) ) {
                //echo $input['chk_create'][$i]." - Create - <br>";
                $input['delete'][$i] = $input['chk_delete'][$i];
            }else{
                $input['delete'][$i] = '0';
            }

            if ( isset($input['chk_view'][$i]) ) {
                //echo $input['chk_create'][$i]." - Create - <br>";
                $input['view'][$i] = $input['chk_view'][$i];
            }else{
                $input['view'][$i] = '0';
            }

                /*if ( isset($input['chk_edit_'.[$i]]) ) {
                    //echo $input['chk_edit'][$i]." - Edit - <br>";
                    $input['edit'][$i] = $input['chk_edit_'.[$i]];
                }else{
                    $input['edit'][$i] = '0';
                }

                if ( isset($input['chk_delete'.[$i]]) ) {
                    //echo $input['chk_delete'][$i]." - Delete - <br>";
                    $input['delete'][$i] = $input['chk_delete_'.[$i]];
                }else{
                    $input['delete'][$i] = '0';
                }

                if ( isset($input['chk_view_'.[$i]]) ) {
                    //echo $input['chk_view'][$i]." - View - <br>";
                    $input['view'][$i] = $input['chk_view_'.[$i]];
                }else{
                    $input['view'][$i] = '0';
                }
                */
            $menu_permission                    = new MenuPermission;

            $menu_permission->menu_id           = $input['menu_id'][$i];
            $menu_permission->designation_id    = $designation_id;
            $menu_permission->create            = $input['create'][$i];
            $menu_permission->edit              = $input['edit'][$i];
            $menu_permission->delete            = $input['delete'][$i];
            $menu_permission->view              = $input['view'][$i];
        
            $menu_permission->save();
                
        }
        return true;


        /*if ($menu_permission->save()) {
           
            $insertedId = $menu_permission->id;

            return $insertedId;
        }*/

        //throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param  $input
     * @return mixed
     */
    public function createMenuPermissionStub($input, $designation_id)
    {
        
        //$menu_permission                    = new MenuPermission;

        
       //echo "string----<br><br><pre>";
       //print_r($menu_permission);//die
//die;

        /*$menu_permission->menu_id           = $input['menu_id'];
        $menu_permission->designation_id    = $input['designation_id'];
        $menu_permission->create            = $input['create'];
        $menu_permission->edit              = $input['edit'];
        $menu_permission->delete            = $input['delete'];
        $menu_permission->view              = $input['view'];*/
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
        //echo "<pre>";print_r($input);
        $designation_id = $input['id'];//die;
        
        for ($i=1; $i <= count($input['menu_id']) ; $i++) {

            
            //print_r($menu_permission);die;
            if ( isset($input['menu_id'][$i]) ) {
                //echo $input['chk_create'][$i]." - Create - <br>";
                $input['menu'][$i] = $input['menu_id'][$i];
            }else{
                $input['menu'][$i] = '0';
            }

            if ( isset($input['chk_create'][$i]) ) {
                //echo $input['chk_create'][$i]." - Create - <br>";
                $input['create'][$i] = $input['chk_create'][$i];
            }else{
                $input['create'][$i] = '0';
            }

            if ( isset($input['chk_edit'][$i]) ) {
                //echo $input['chk_create'][$i]." - Create - <br>";
                $input['edit'][$i] = $input['chk_edit'][$i];
            }else{
                $input['edit'][$i] = '0';
            }

            if ( isset($input['chk_delete'][$i]) ) {
                //echo $input['chk_create'][$i]." - Create - <br>";
                $input['delete'][$i] = $input['chk_delete'][$i];
            }else{
                $input['delete'][$i] = '0';
            }

            if ( isset($input['chk_view'][$i]) ) {
                //echo $input['chk_create'][$i]." - Create - <br>";
                $input['view'][$i] = $input['chk_view'][$i];
            }else{
                $input['view'][$i] = '0';
            }

           
//echo $designation_id." , ".$input['menu_id'][$i]."<br>" ;
            $get_menu_permission = $this->getMenuPermission($designation_id, $input['menu_id'][$i] );
            //print_r($get_menu_permission);
            if ( (!empty($get_menu_permission)) ) {
                //$eid = $get_menu_permission[0]['id'];
                $menu_permission = $this->findOrThrowException($get_menu_permission);

                //if ($menu_permission->update($input)) {
               
                    
                    //For whatever reason this just wont work in the above call, so a second is needed for now
                    $menu_permission->menu_id           = $input['menu_id'][$i];
                    $menu_permission->designation_id    = $designation_id;
                    $menu_permission->create            = $input['create'][$i];
                    $menu_permission->edit              = $input['edit'][$i];
                    $menu_permission->delete            = $input['delete'][$i];
                    $menu_permission->view              = $input['view'][$i];
        
                    $menu_permission->save();
                    //return true;
                //}
            }else{
               /* if ($input['menu_id'][$i] == 5) {
                    echo "dfdfdfdfdf";die;
                }*/
                //create -> save data
                if ( (empty($get_menu_permission)) ) {
                    //echo "dfd - ".$input['menu_id'][$i];die;
                $menu_permission_store                    = new MenuPermission;

                $menu_permission_store->menu_id           = $input['menu_id'][$i];
                $menu_permission_store->designation_id    = $designation_id;
                $menu_permission_store->create            = $input['create'][$i];
                $menu_permission_store->edit              = $input['edit'][$i];
                $menu_permission_store->delete            = $input['delete'][$i];
                $menu_permission_store->view              = $input['view'][$i];
            
                $menu_permission_store->save();
                }
            }

        }        
        /*echo "---<br><br><pre>";
        print_r($input);
        die;*/
        return true;
        /*if ($menu_permission->update($input)) {
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
        }*/

        //throw new GeneralException(trans('exceptions.backend.access.users.update_error'));
    }

    public function getDesignationPermission($id)
    {
        /*if ($withRoles) {
            $user = Course::with('roles')->withTrashed()->find($id);
        } else {*/
            //$course = Course::withTrashed()->find($id);
            $menu_permission = MenuPermission::where('designation_id', $id)->get();
            //$menu_permission = MenuPermission::find($id);
        /*}*/

        if (!is_null($menu_permission)) {
            return $menu_permission;
        }
    }

    public function getMenuPermission($designation_id, $menu_id)
    {
        
        $menu_permission = MenuPermission::where('designation_id', $designation_id)->where('menu_id', $menu_id)->get();


        /*if ($menu_id == 5) {
            echo "dddd";
            echo "<pre>";print_r($menu_permission);   */
            if (!empty($menu_permission[0]['id'])) {
                //echo "string";die;
                return $menu_permission[0]['id'];
            }
            //die;
        //}
        
        /*if (!is_null($menu_permission)) {
            return $menu_permission[0]['id'];
        }else{
            return flase;
        }*/
    }

     /**
     * @param  $id
     * @throws GeneralException
     * @return boolean|null
     */
    public function delete($id)
    {
        //print_r($id);echo "menu string";die;

        //$menu_permission = $this->findOrThrowException($id, true);
        $desg_menu = $this->getDesignationPermission($id);
//print_r($desg_menu);die;
        try {
            //$course->forceDelete();
            for ($i=0; $i < count($desg_menu) ; $i++) { 
                $menu_permission = $this->findOrThrowException($desg_menu[$i]['id'], true);
                $menu_permission->delete();
            }
            
            return true;

        } catch (\Exception $e) {
           // throw new GeneralException($e->getMessage());
        }
    }

    
}
