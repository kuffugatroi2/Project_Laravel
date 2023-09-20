<?php

namespace App\Repositories\CategoryProduct;

use App\Repositories\AbstractRepositoryInterface;

interface CategoryProductRepositoryInterface extends AbstractRepositoryInterface
{
    public function statusChange($id, $itemStatus);
    public function getCategory($idBrand);
    public function getArrayNameCategoryProduct();
}
