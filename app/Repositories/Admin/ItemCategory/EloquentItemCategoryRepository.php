<?php

namespace App\Repositories\Admin\ItemCategory;

use App\Models\Admin\ItemCategory\ItemCategory;
use DB;


/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class EloquentItemCategoryRepository implements ItemCategoryRepositoryContract
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
        $itemCategory = ItemCategory::find($id);
        if (!is_null($itemCategory)) {
            return $itemCategory;
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
    public function getItemCategoryPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc')
    {
       
        return ItemCategory::orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedItemCategoryPaginated($per_page)
    {
        return ItemCategory::onlyTrashed()
            ->paginate($per_page);
    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllItemCategory($order_by = 'id', $sort = 'asc')
    {
        return ItemCategory::orderBy($order_by, $sort)
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
       $itemCategory = $this->createItemCategoryStub($input);
       //print_r($course);die;


        if ($itemCategory->save()) {
           
            $insertedId = $itemCategory->id;

            return $insertedId;
        }

        //throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param  $input
     * @return mixed
     */
    public function createItemCategoryStub($input)
    {
        
        $itemCategory                    = new ItemCategory;
        $itemCategory->category_name     = $input['category_name'];
        return $itemCategory;
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
        $itemCategory = $this->findOrThrowException($input['id']);
        if ($itemCategory->update($input)) {
            //For whatever reason this just wont work in the above call, so a second is needed for now
            $itemCategory->category_name     = $input['category_name'];
            $itemCategory->save();
            return true;
        }

    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return boolean|null
     */
    public function delete($id)
    {
        $itemCategory = $this->findOrThrowException($id, true);

        try {

            $itemCategory->delete();
            return true;

        } catch (\Exception $e) {
        }
    }
    
}
