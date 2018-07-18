<?php

namespace App\Repositories\Admin\Item;

use App\Models\Admin\Item\Item;
use DB;


/**
 * Class EloquentDesignationRepository
 * @package App\Repositories\Designation
 */
class EloquentItemRepository implements ItemRepositoryContract
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
            $item = Item::find($id);
        /*}*/

        if (!is_null($item)) {
            return $item;
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
    public function getItemPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        /*return Item::orderBy($order_by, $sort)
            ->paginate($per_page);*/

        return Item::leftJoin('vendors', 'vendors.id', '=', 'items.vendor_id')
            ->leftJoin('item_categories', 'item_categories.id', '=', 'items.item_category_id')
            ->leftJoin('item_types', 'item_types.id', '=', 'items.item_type_id')
            ->select( 'items.*', 'vendors.first_name', 'vendors.last_name', 'item_types.item_type', 'item_categories.category_name')
            ->get();
    }

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedItemPaginated($per_page)
    {
        return Item::onlyTrashed()
            ->paginate($per_page);
    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllItem($order_by = 'id', $sort = 'asc')
    {
        return Item::orderBy($order_by, $sort)
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
       $item = $this->createUserStub($input);
        if ($item->save()) {
            $insertedId = $item->id;
            return $insertedId;
        }

        //throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param  $input
     * @return mixed
     */
    public function createUserStub($input)
    {
        $item                         = new Item;
        $item->item_category_id       = $input['item_category_id'];
        $item->item_type_id           = $input['item_type_id'];
        $item->vendor_id              = $input['vendor_id'];
        $item->item_name              = $input['item_name'];
        $item->item_code              = $input['item_code'];

        $new_photo = '';
        //if ($input->hasFile('item_image')) {
        if (isset($input['item_image']) ){
            $image = $input['item_image'];
            $img = $_FILES["item_image"]["name"];//$image->getClientOriginalExtension();
            $new_photo = date('YmdHis')."_".uniqid()."_".$img;
            $destinationPath = public_path('/uploads/item/images');
            $image->move($destinationPath, $new_photo);
        }

        $item->item_image             = $new_photo;
        $item->item_description       = $input['item_description'];
        
        return $item;
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
        $item = $this->findOrThrowException($input['id']);
        $new_photo = '';
        if ($item->update($input)) {
            //For whatever reason this just wont work in the above call, so a second is needed for now
            $item->item_category_id              = $input['item_category_id'];
            $item->vendor_id              = $input['vendor_id'];
            $item->item_name              = $input['item_name'];
            $item->item_code           = $input['item_code'];

            if (isset($input['item_image'])) {
                $image = $input['item_image'];
                $img = $input['item_image']['name'];
                $new_photo = $date('YmdHis')."_".uniqid()."_".$img;
                $destinationPath = public_path('uploads/item/images');
                $image->move($destinationPath, $new_photo);
            }else if($item->item_image != ''){
                $new_photo = $item->item_image;     
            }

            $item->item_image           = $new_photo;
            $item->item_description           = $input['item_description'];
            
            $item->save();

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
        $item = $this->findOrThrowException($id, true);

        try {
            $item->delete();
            return true;

        } catch (\Exception $e) {
            //print_r($e->getMessage());
           // throw new GeneralException($e->getMessage());
        }
    }
    
}
