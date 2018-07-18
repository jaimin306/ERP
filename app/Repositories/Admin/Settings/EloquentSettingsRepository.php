<?php

namespace App\Repositories\Admin\Settings;

use App\Models\Admin\Settings;
use DB;


/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class EloquentSettingsRepository implements SettingsRepositoryContract
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
        $settings = DB::table('config')
        ->select('config.*')
        ->pluck('value', 'title');


        if (!is_null($settings)) {
            return $settings;
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
    public function getSettingsPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        /*return Country::where('status', $status)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);*/
        return Settings::orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedSettingsPaginated($per_page)
    {
        return Settings::onlyTrashed()
            ->paginate($per_page);
    }

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllSettings($order_by = 'id', $sort = 'asc')
    {
        return Settings::orderBy($order_by, $sort)
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
       $settings = $this->createSettingsStub($input);
       //print_r($course);die;


        if ($settings->save()) {
           
            $insertedId = $settings->id;

            return $insertedId;
        }

        //throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param  $input
     * @return mixed
     */
    public function createSettingsStub($input)
    {
        
        $settings                    = new Settings;
        $settings->setting_type      = $input['setting_type'];
        
        return $settings;
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
        $settings = $this->findOrThrowException($input['id']);
        //$this->checkUserByEmail($input, $user);
        //print_r($course);die;

        

        if ($settings->update($input)) {
            //For whatever reason this just wont work in the above call, so a second is needed for now
            $settings->setting_type              = $input['setting_type'];
            $settings->save();

            //$this->checkUserRolesCount($roles);
            //$this->flushRoles($roles, $user);
            //$this->flushPermissions($permissions, $user);

            return true;
        }

        //throw new GeneralException(trans('exceptions.backend.access.users.update_error'));
    }
    public function updateCompanySetting($input)
    {
        // print_r($input);die;
        foreach ($input as $key => $value) {
            DB::table('config')
                ->where('title', $key)
                ->update(['value' => $value]);
        }
        return true;

    } 
    public function updateEmailSetting($input)
    {
        // print_r($input);die;
        foreach ($input as $key => $value) {
            DB::table('config')
                ->where('title', $key)
                ->update(['value' => $value]);
        }
        return true;

    }
    public function updateSystemSetting($input)
    {
        // print_r($input);die;
        foreach ($input as $key => $value) {
            DB::table('config')
                ->where('title', $key)
                ->update(['value' => $value]);
        }
        return true;

    }
    public function getStateByCountry($id)
    {
        return $states = DB::table('states')->where('country_id', $id)->get();
    }

    /**
     * @param  $id
     * @throws GeneralException
     * @return boolean|null
     */
    public function delete($id)
    {
        //print_r($id);echo "string";die;

        $settings = $this->findOrThrowException($id, true);

        try {

            //$course->forceDelete();
            $settings->delete();
            return true;

        } catch (\Exception $e) {
           // throw new GeneralException($e->getMessage());
        }
    }
    
}
