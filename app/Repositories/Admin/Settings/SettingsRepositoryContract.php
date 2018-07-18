<?php

namespace App\Repositories\Admin\Settings;

/**
 * Interface UserRepositoryContract
 * @package App\Repositories\User
 */
interface SettingsRepositoryContract
{
    /**
     * @param  $id
     * @param  bool    $withRoles
     * @return mixed
     */
    public function findOrThrowException($id, $withRoles = false);

    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @param  $status
     * @return mixed
     */
    public function getSettingsPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc');

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedSettingsPaginated($per_page);

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllSettings($order_by = 'id', $sort = 'asc');

    public function create($input);

    public function update($input);

    public function updateCompanySetting($input);
    
    public function updateEmailSetting($input);

    public function updateSystemSetting($input);

    public function getStateByCountry($id);

    public function delete($id);

   
}
