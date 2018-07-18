<?php

namespace App\Repositories\Admin\ItemType;

use App\Models\Admin\ItemType\ItemType;
use DB;


/**
 * Class EloquentStateRepository
 * @package App\Repositories\State
 */
class EloquentItemTypeRepository implements ItemTypeRepositoryContract
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
        $itemType = ItemType::find($id);
        if (!is_null($itemType)) {
            return $itemType;
        }
    }

    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @param  int         $status
     * @return mixed
     */
    public function getItemTypePaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return ItemType::leftJoin('item_categories as ic', 'ic.id', '=', 'item_types.item_category_id')->select('ic.category_name', 'item_types.*')->get();
    }

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedItemTypePaginated($per_page)
    {
        return ItemType::onlyTrashed()
            ->paginate($per_page);
    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllItemType($order_by = 'id', $sort = 'asc')
    {
        return ItemType::orderBy($order_by, $sort)
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

       $itemType = $this->createItemTypeStub($input);
       
        if ($itemType->save()) {
           
            $insertedId = $itemType->id;

            return $insertedId;
        }

        //throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param  $input
     * @return mixed
     */
    public function createItemTypeStub($input)
    {
        
        $itemType                       = new ItemType;
        $itemType->item_category_id     = $input['item_category_id'];
        $itemType->item_type            = $input['item_type'];
        
        return $itemType;
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
        $itemType = $this->findOrThrowException($input['id']);
        if ($itemType->update($input)) {
            $itemType->item_category_id     = $input['item_category_id'];
            $itemType->item_type            = $input['item_type'];
            $itemType->save();

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

        $itemType = $this->findOrThrowException($id, true);

        try {

            //$course->forceDelete();
            $itemType->delete();
            return true;

        } catch (\Exception $e) {
           // throw new GeneralException($e->getMessage());
        }
    }

    public function getCategoryType($id)
    {
        $item_types = ItemType::where('item_category_id', $id)->get();
        return $item_types;
    }
    
}
