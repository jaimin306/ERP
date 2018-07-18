<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\ItemType\ItemTypeRepositoryContract;
use App\Repositories\Admin\ItemCategory\ItemCategoryRepositoryContract;
use App\Http\Requests\Admin\ItemType\CreateItemTypeRequest;
use App\Http\Requests\Admin\ItemType\StoreItemTypeRequest;
use App\Http\Requests\Admin\ItemType\UpdateItemTypeRequest;
use App\Http\Requests\Admin\ItemType\PermanentlyDeleteItemTypeRequest;
use App\Http\Requests;
use Illuminate\Http\Request;

use Flash;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class ItemTypeController extends Controller
{

	/**
     * @var CourseRepositoryContract
     */
    protected $itemType;

    /**
     * @var CourseRepositoryContract
     */
    protected $itemCategory;
    

    /**
     * @param CourseRepositoryContract       $courses
     */
    public function __construct(ItemTypeRepositoryContract $itemType,
        ItemCategoryRepositoryContract $itemCategory
    )
    {
        $this->itemType = $itemType;
        $this->itemCategory = $itemCategory;
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
        return view('Admin.itemType.itemType')
            ->withItemTypes($this->itemType->getItemTypePaginated(config('access.users.default_per_page'), 1));
    }

    /**
     * @param  CreateUserRequest $request
     * @return mixed
     */
    public function create(CreateItemTypeRequest $request)
    {
        return view('Admin.itemType.create')->withCategories($this->itemCategory->getAllItemCategory());
    }

     /**
     * @param  StoreUserRequest $request
     * @return mixed
     */
    public function store(StoreItemTypeRequest $request)
    {
    	
		$input = $request->all();
        $itemType = $this->itemType->create($request->all());
        // \Session::flash('noti','successfully');
        // $request->session()->flash('noti','successfully');
        return redirect()->route('admin.itemType')->with('status', 'New Record was added');
    }

    public function edit($id)
    {
        //echo "string";die;
        $itemType = $this->itemType->findOrThrowException( $id );
        $categories = $this->itemCategory->getAllItemCategory();
        //print_r($state);die;
        return view('Admin.itemType.create', ["itemType"=>$itemType, "categories"=>$categories]);
    }

    public function update(UpdateItemTypeRequest $request)
    {
        $id = $request->id;//die;
        $this->itemType->update($request->all() );

    	$notification = array(
            'status' => 'success',
            'msg' => 'Record updated successfully',
        );
        Flash::success('This is a success message.');
        //return Response::json($response);
        //return response()->json($response);
        return redirect()->route('admin.itemType')->with('noti','hakjsdhfkjdasfkjkjdasf');
    }

    

    /**
     * @param  $id
     * @param  PermanentlyDeleteUserRequest $request
     * @return mixed
     */
    //public function delete($id)
    public function delete(Request $request)
    {
        $id = $request->id;
        $destroyed = $this->itemType->delete($id);
        $json['status'] = $destroyed ? 1 : 0;
        return response()->json($json);
        
    }

    


}