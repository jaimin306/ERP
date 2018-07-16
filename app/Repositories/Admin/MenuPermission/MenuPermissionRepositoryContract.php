<?php

namespace App\Repositories\Admin\MenuPermission;

/**
 * Interface UserRepositoryContract
 * @package App\Repositories\User
 */
interface MenuPermissionRepositoryContract
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
    public function getMenuPermissionPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc');

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedMenuPermissionPaginated($per_page);

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllMenuPermission($order_by = 'id', $sort = 'asc');

    public function create($input, $designation_id);

    public function update($input);

    public function delete($id);

   
}
