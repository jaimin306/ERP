<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\ItemCategory\ItemCategoryRepositoryContract;
use App\Http\Requests\Admin\ItemCategory\CreateItemCategoryRequest;
use App\Http\Requests\Admin\ItemCategory\StoreItemCategoryRequest;
use App\Http\Requests\Admin\ItemCategory\UpdateItemCategoryRequest;
use App\Http\Requests\Admin\ItemCategory\DeleteItemCategoryRequest;
use App\Http\Requests;
use Illuminate\Http\Request;

use Session;




/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class ItemCategoryController extends Controller
{

	/**
     * @var CourseRepositoryContract
     */
    protected $itemCategory;
    

    /**
     * @param CourseRepositoryContract       $courses
     */
    public function __construct(ItemCategoryRepositoryContract $itemCategory)
    {
        $this->itemCategory = $itemCategory;
    }


    /**
     * @return mixed
     */
    public function index()
    {
        return view('Admin.itemCategory.itemCategory')
            ->withItemCategory($this->itemCategory->getItemCategoryPaginated(config('access.users.default_per_page'), 1));
    }

    /**
     * @param  CreateUserRequest $request
     * @return mixed
     */
    public function create(CreateItemCategoryRequest $request)
    {
        return view('Admin.itemCategory.create');
    }

     /**
     * @param  StoreUserRequest $request
     * @return mixed
     */
    public function store(StoreItemCategoryRequest $request)
    {
    	
		$input = $request->all();
        $itemCategory = $this->itemCategory->create($request->all());

        return redirect()->route('admin.itemCategory')->withFlashSuccess('Record inserted successfully');
        //return redirect()->route('admin.itemCategory')->with('status', 'New book was added');
    }

    public function edit($id)
    {
        //echo "string";die;
        $itemCategory = $this->itemCategory->findOrThrowException( $id );
        //print_r($itemCategory);die;
        return view('Admin.itemCategory.create', ["itemCategory"=>$itemCategory]);
    }

    public function update(UpdateItemCategoryRequest $request)
    {
        $id = $request->id;//die;
        $this->itemCategory->update($request->all() );

    	$response = array(
            'status' => 'success',
            'msg' => 'Record updated successfully',
        );
        return redirect()->route('admin.itemCategory')->withFlashSuccess('Record updated successfully');
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
        $destroyed = $this->itemCategory->delete($id);
        $json['status'] = $destroyed ? 1 : 0;
        return response()->json($json);
        
    }

    


}