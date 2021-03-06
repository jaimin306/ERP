<?php

namespace App\Repositories\Admin\User;

/**
 * Interface UserRepositoryContract
 * @package App\Repositories\User
 */
interface UserRepositoryContract
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
    public function getUserPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc');

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedUserPaginated($per_page);

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllUser($order_by = 'id', $sort = 'asc');

    public function create($input);

    public function update($input);

    public function delete($id);

    public function chkUniqueUserEmail($email, $eid);

   
}
