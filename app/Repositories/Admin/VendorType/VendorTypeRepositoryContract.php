<?php

namespace App\Repositories\Admin\VendorType;

/**
 * Interface UserRepositoryContract
 * @package App\Repositories\User
 */
interface VendorTypeRepositoryContract
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
    public function getVendorTypePaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc');

    /**
     * @param  $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedVendorTypePaginated($per_page);

    /**
     * @param  string  $order_by
     * @param  string  $sort
     * @return mixed
     */
    public function getAllVendorType($order_by = 'id', $sort = 'asc');

    public function create($input);

    public function update($input);

    public function delete($id);

   
}
