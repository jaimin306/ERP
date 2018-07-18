<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Item\ItemRepositoryContract;
use App\Repositories\Admin\ItemCategory\ItemCategoryRepositoryContract;
use App\Repositories\Admin\ItemType\ItemTypeRepositoryContract;
use App\Repositories\Admin\Vendor\VendorRepositoryContract;
use App\Http\Requests\Admin\Item\CreateItemRequest;
use App\Http\Requests\Admin\Item\StoreItemRequest;
use App\Http\Requests\Admin\Item\UpdateItemRequest;
use App\Http\Requests\Admin\Item\PermanentlyDeleteItemRequest;
use App\Http\Requests\Admin\Item\GetTypeRequest;

use App\Http\Requests;


/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class ItemController extends Controller
{

    protected $item;
    protected $item_category;
    protected $item_type;
    protected $vendor;

    
    /**
     * @param UserRepositoryContract       $user
     */
    public function __construct(ItemRepositoryContract $item,
        ItemCategoryRepositoryContract $item_category,
        ItemTypeRepositoryContract $item_type,
        VendorRepositoryContract $vendor
    )
    {
        $this->item = $item;
        $this->item_category = $item_category;
        $this->item_type = $item_type;
        $this->vendor = $vendor;
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
        return view('Admin.item.item')
            ->withItems($this->item->getItemPaginated(config('access.users.default_per_page'), 1));
    }

    /**
     * @param  CreateUserRequest $request
     * @return mixed
     */
    public function create(CreateItemRequest $request)
    {
        return view('Admin.item.create')
            ->withItemCategories($this->item_category->getAllItemCategory())
            ->withItemTypes($this->item_type->getAllItemType())
            ->withVendors($this->vendor->getAllVendor());
    }

     /**
     * @param  StoreUserRequest $request
     * @return mixed
     */
    public function store(StoreItemRequest $request)
    {
        $item = $this->item->create($request->all());
        return redirect()->route('admin.item')->withFlashSuccess('Record inserted successfully');
    }

    public function edit($id)
    {
        $item = $this->item->findOrThrowException( $id );        
        $item_category = $this->item_category->getAllItemCategory();
        $item_type = $this->item_type->getAllItemType();
        $vendor = $this->vendor->getAllVendor();

        //print_r($designation);die;
        return view('Admin.item.create', ["item"=>$item, "itemCategories"=>$item_category, "itemTypes"=>$item_type, "vendors"=>$vendor]);
    }

    public function update(UpdateItemRequest $request)
    {
        $id = $request->id;//die;
        $item = $this->item->update($request->all() );

        $response = array(
            'status' => 'success',
            'msg' => 'Record updated successfully',
        );
        //return Response::json($response);
        //return response()->json($response);
        return redirect()->route('admin.item')->with('status','Record updated successfully');
    }

   
    /**
     * @param  $id
     * @param  PermanentlyDeleteUserRequest $request
     * @return mixed
     */
    //public function delete($id)
    public function delete(PermanentlyDeleteItemRequest $request)
    {
        $id = $request->id;
        $destroyed = $this->item->delete($id);
        
        $json['status'] = $destroyed ? 1 : 0;
        
        return response()->json($json);
        
    }

    public function getType($id, GetTypeRequest $request)
    {
        
        $types = $this->item_type->getCategoryType($id);

        $str = '';
        $str.='<select name="item_type_id" id="item_type_id" class="form-control select2" >';
        $str.='<option value="">Select Item Type</option>';
        foreach ($types as $type) {
            if ( ($request->type_id != '') && ($request->type_id == $type->id) ) {
                $selected = 'selected=selected';
            }else{
                $selected = '';
            }
            $str.='<option value="'.$type->id.'" '.$selected.' >'.$type->item_type.'</option>';
        }
        $str.='</select>';
        echo $str;
    }

    


}