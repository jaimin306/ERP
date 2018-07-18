<?php

namespace App\Repositories\Admin\Item;

/**
 * Interface UserRepositoryContract
 * @package App\Repositories\User
 */
interface ItemRepositoryContract
{
    public function findOrThrowException($id, $withRoles = false);

    
    public function getItemPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc');

    public function getDeletedItemPaginated($per_page);

    public function getAllItem($order_by = 'id', $sort = 'asc');

    public function create($input);

    public function update($input);

    public function delete($id);

   
}
