<?php

namespace App\Repositories\Admin\AccountType;

/**
 * Interface UserRepositoryContract
 * @package App\Repositories\User
 */
interface AccountTypeRepositoryContract
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
    public function getAccountTypePaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc');

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedAccountTypePaginated($per_page);

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllAccountType($order_by = 'id', $sort = 'asc');

    public function create($input);

    public function update($input);

    public function delete($id);

   
}
