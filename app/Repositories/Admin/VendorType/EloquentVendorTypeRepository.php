<?php

namespace App\Repositories\Admin\VendorType;

use App\Models\Admin\VendorType\VendorType;
use DB;


/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class EloquentVendorTypeRepository implements VendorTypeRepositoryContract
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
            $vendor_type = VendorType::find($id);
        /*}*/

        if (!is_null($vendor_type)) {
            return $vendor_type;
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
    public function getVendorTypePaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        /*return Country::where('status', $status)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);*/
        return VendorType::orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedVendorTypePaginated($per_page)
    {
        return VendorType::onlyTrashed()
            ->paginate($per_page);
    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllVendorType($order_by = 'id', $sort = 'asc')
    {
        return VendorType::orderBy($order_by, $sort)
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
       $vendor_type = $this->createCountryStub($input);
       //print_r($course);die;


        if ($vendor_type->save()) {
           
            $insertedId = $vendor_type->id;

            return $insertedId;
        }

        //throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param  $input
     * @return mixed
     */
    public function createCountryStub($input)
    {
        
        $vendor_type                    = new VendorType;
        $vendor_type->vendor_type_name              = $input['vendor_type_name'];
        
        
        return $vendor_type;
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
        $vendor_type = $this->findOrThrowException($input['id']);
        //$this->checkUserByEmail($input, $user);
        //print_r($course);die;

        

        if ($vendor_type->update($input)) {
            //For whatever reason this just wont work in the above call, so a second is needed for now
            $vendor_type->vendor_type_name              = $input['vendor_type_name'];
            $vendor_type->save();

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

        $vendor_type = $this->findOrThrowException($id, true);

        try {

            //$course->forceDelete();
            $vendor_type->delete();
            return true;

        } catch (\Exception $e) {
           // throw new GeneralException($e->getMessage());
        }
    }
    
}
