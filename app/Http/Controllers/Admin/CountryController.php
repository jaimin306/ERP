<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Country\CountryRepositoryContract;
use App\Http\Requests\Admin\Country\CreateCountryRequest;
use App\Http\Requests\Admin\Country\StoreCountryRequest;
use App\Http\Requests\Admin\Country\UpdateCountryRequest;
use App\Http\Requests;

use Session;



/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class CountryController extends Controller
{

	/**
     * @var CourseRepositoryContract
     */
    protected $country;
    

    /**
     * @param CourseRepositoryContract       $courses
     */
    public function __construct(CountryRepositoryContract $country)
    {
        $this->country = $country;
    }


    /**
     * @return mixed
     */
    public function index()
    {
        return view('Admin.country.country')
            ->withCountries($this->country->getCountryPaginated(config('access.users.default_per_page'), 1));
    }

    /**
     * @param  CreateUserRequest $request
     * @return mixed
     */
    public function create(CreateCountryRequest $request)
    {
        return view('Admin.country.create');
    }

     /**
     * @param  StoreUserRequest $request
     * @return mixed
     */
    public function store(StoreCountryRequest $request)
    {
    	
		$input = $request->all();
        $country = $this->country->create($request->all());

        return redirect()->route('admin.country')->withFlashSuccess('Record inserted successfully');
        //return redirect()->route('admin.country')->with('status', 'New book was added');
    }

    public function edit($id)
    {
        //echo "string";die;
        $country = $this->country->findOrThrowException( $id );
        //print_r($country);die;
        return view('Admin.country.create', ["country"=>$country]);
    }

    public function update(UpdateCountryRequest $request)
    {
        $id = $request->id;//die;
        $this->country->update($request->all() );

    	$response = array(
            'status' => 'success',
            'msg' => 'Record updated successfully',
        );
        //return Response::json($response);
        //return response()->json($response);
        return redirect()->route('admin.country')->withFlashSuccess('Record updated successfully');
    }

    public function destroy()
    {
    	$id=$_POST['id'];//die;

        $destroyed = $country->delete();

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
        
        $destroyed = $this->country->delete($id);
        $json['status'] = $destroyed ? 1 : 0;
        //echo json_encode($json);
        //return Response::json($json_encode);
        return response()->json($json);
        //return redirect()->back()->withFlashSuccess('Record deleted successfully');
        //return redirect()->route('admin.country')->withFlashSuccess('Record deleted successfully');
    }

    


}