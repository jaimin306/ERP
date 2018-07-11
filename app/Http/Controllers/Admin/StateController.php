<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\State\StateRepositoryContract;
use App\Repositories\Admin\Country\CountryRepositoryContract;
use App\Http\Requests\Admin\State\CreateStateRequest;
use App\Http\Requests\Admin\State\StoreStateRequest;
use App\Http\Requests\Admin\State\UpdateStateRequest;
use App\Http\Requests;




/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class StateController extends Controller
{

	/**
     * @var CourseRepositoryContract
     */
    protected $state;

    /**
     * @var CourseRepositoryContract
     */
    protected $country;
    

    /**
     * @param CourseRepositoryContract       $courses
     */
    public function __construct(StateRepositoryContract $state,
        CountryRepositoryContract $country
    )
    {
        $this->state = $state;
        $this->country = $country;
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
        return view('Admin.state.state')
            ->withStates($this->state->getStatePaginated(config('access.users.default_per_page'), 1));
    }

    /**
     * @param  CreateUserRequest $request
     * @return mixed
     */
    public function create(CreateStateRequest $request)
    {
        return view('Admin.state.create')
            ->withCountries($this->country->getCountryPaginated(config('access.users.default_per_page'), 1));
    }

     /**
     * @param  StoreUserRequest $request
     * @return mixed
     */
    public function store(StoreStateRequest $request)
    {
    	
		$input = $request->all();
        $state = $this->state->create($request->all());

        //return redirect()->route('admin.state')->withFlashSuccess('Record inserted successfully');
        return redirect()->route('admin.state')->with('status', 'New book was added');
    }

    public function edit($id)
    {
        //echo "string";die;
        $state = $this->state->findOrThrowException( $id );
        $countries = $this->country->getAllCountry();
        //print_r($state);die;
        return view('Admin.state.create', ["state"=>$state, "countries"=>$countries]);
    }

    public function update(UpdateStateRequest $request)
    {
        $id = $request->id;//die;
        $this->state->update($request->all() );

    	$response = array(
            'status' => 'success',
            'msg' => 'Record updated successfully',
        );
        //return Response::json($response);
        //return response()->json($response);
        return redirect()->route('admin.state')->withFlashSuccess('Record updated successfully');
    }

    public function destroy()
    {
    	$id=$_POST['id'];//die;

        $destroyed = $state->delete();

        $json['status'] = $destroyed ? 1 : 0;
        //echo json_encode($json);
        //return Response::json($json_encode);
        return response()->json($json);
    }

    /**
     * @param  $id
     * @param  PermanentlyDeleteUserRequest $request
     * @return mixed
     */
    //public function delete($id)
    public function delete()
    {
        //echo "dsf";print_r($request);die;
        $id = $_REQUEST['id'];//die;
        
        $destroyed = $this->state->delete($id);
        $json['status'] = $destroyed ? 1 : 0;
        //echo json_encode($json);
        //return Response::json($json_encode);
        return response()->json($json);
        //return redirect()->back()->withFlashSuccess('Record deleted successfully');
        //return redirect()->route('admin.state')->withFlashSuccess('Record deleted successfully');
    }

    


}