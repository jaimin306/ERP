<?php

namespace App\Repositories\Admin\User;

use Carbon\Carbon;
use App\Models\Admin\User\User;
use DB;


/**
 * Class EloquentDesignationRepository
 * @package App\Repositories\Designation
 */
class EloquentUserRepository implements UserRepositoryContract
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
            $user = User::find($id);
        /*}*/

        if (!is_null($user)) {
            return $user;
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
    public function getUserPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return User::orderBy($order_by, $sort)
            ->paginate($per_page);

        /*return User::leftJoin('departments', 'departments.id', '=', 'designations.department_id')
            ->select( 'designations.designation_name', 'designations.id as designation_id', 'departments.department_name', 'departments.id as department_id', 'designations.department_id as designation_department_id')
            ->get();*/
    }

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedUserPaginated($per_page)
    {
        return User::onlyTrashed()
            ->paginate($per_page);
    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllUser($order_by = 'id', $sort = 'asc')
    {
        return User::orderBy($order_by, $sort)
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
       $user = $this->createUserStub($input);

        if ($user->save()) {
           
            $insertedId = $user->id;

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
        
        //$ composer require nesbot/carbon
        /*'last_login_at' => Carbon::now()->toDateTimeString(),
        'last_login_ip' => $request->getClientIp()*/
        //echo
        $input['last_login'] = Carbon::now();//die;
        $user                    = new User;
        $user->user_name              = $input['user_name'];
        $user->department_id              = $input['department_id'];
        $user->designation_id              = $input['designation_id'];
        $user->first_name              = $input['first_name'];
        $user->last_name              = $input['last_name'];
        $user->email              = $input['email'];
        //$user->password              = $input['password'];
        $user->password          = hash('sha512',($input['password']));
        $user->last_login          = $input['last_login'];
        $user->last_ip              = \Request::ip();
        $user->phone              = $input['phone'];
        $user->website              = $input['website'];
        
        //die;
        //print_r($user);die;
        
        return $user;
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
        $user = $this->findOrThrowException($input['id']);
        //$this->checkUserByEmail($input, $user);
        //print_r($course);die;

        

        if ($user->update($input)) {
            $input['last_login'] = Carbon::now();//die;
            //For whatever reason this just wont work in the above call, so a second is needed for now
            $user->user_name              = $input['user_name'];
            $user->department_id              = $input['department_id'];
            $user->designation_id              = $input['designation_id'];
            $user->email              = $input['email'];
            //$user->password          = hash('sha512',($input['password']));
            //$user->password              = $input['password'];
            $user->first_name              = $input['first_name'];
            $user->last_name              = $input['last_name'];
            $user->website              = $input['website'];
            $user->phone              = $input['phone'];
            $user->last_login              = $input['last_login'];
            $user->last_login          = $input['last_login'];
            $user->last_ip              = \Request::ip();
            
            $user->save();

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
        //print_r($id);echo "designa string";die;

        $user = $this->findOrThrowException($id, true);

        try {
            //echo "string";die;
            $user->delete();
            //echo "string";die;
            return true;

        } catch (\Exception $e) {
            print_r($e->getMessage());
           // throw new GeneralException($e->getMessage());
        }
    }

    public function chkUniqueUserEmail($email, $eid)
    {
        if ($eid != '') {
            $user = User::where('email', $email)->where('id', '<>' , $eid)->get();
            //print_r(DB::getQueryLog());die;
        }else{
            $user = User::where('email', $email)->get();    
        }
        
        return $user;
    }
    
}
