<?php

namespace App\Repositories\Admin\State;

use App\Models\Admin\State\State;
use DB;


/**
 * Class EloquentStateRepository
 * @package App\Repositories\State
 */
class EloquentStateRepository implements StateRepositoryContract
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
            $state = State::find($id);
        /*}*/

        if (!is_null($state)) {
            return $state;
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
    public function getStatePaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        /*return State::where('status', $status)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);*/
        /*return State::orderBy($order_by, $sort)
            ->paginate($per_page);*/

        return State::leftJoin('countries', 'countries.id', '=', 'states.country_id')
            ->select('states.name as state_name', 'states.id as state_id', 'states.country_id as state_country_id', 'countries.name as country_name', 'countries.id as country_id')
            ->get();
    }

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedStatePaginated($per_page)
    {
        return State::onlyTrashed()
            ->paginate($per_page);
    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllState($order_by = 'id', $sort = 'asc')
    {
        return State::orderBy($order_by, $sort)
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
       $state = $this->createStateStub($input);
       //print_r($course);die;


        if ($state->save()) {
           
            $insertedId = $state->id;

            return $insertedId;
        }

        //throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param  $input
     * @return mixed
     */
    public function createStateStub($input)
    {
        
        $state                    = new State;
        $state->name              = $input['name'];
        $state->country_id              = $input['country_id'];
        
        //print_r($state);die;
        
        return $state;
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
        $state = $this->findOrThrowException($input['id']);
        //$this->checkUserByEmail($input, $user);
        //print_r($course);die;

        

        if ($state->update($input)) {
            //For whatever reason this just wont work in the above call, so a second is needed for now
            $state->name              = $input['name'];
            $state->country_id              = $input['country_id'];
            
            $state->save();

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

        $state = $this->findOrThrowException($id, true);

        try {

            //$course->forceDelete();
            $state->delete();
            return true;

        } catch (\Exception $e) {
           // throw new GeneralException($e->getMessage());
        }
    }



    public function getCountryState($country_id)
    {
        $state = State::where('country_id', $country_id)->get();
        return $state;
    }
    
}
