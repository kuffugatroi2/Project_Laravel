<?php

namespace App\Repositories\BrandProduct;

use App\Repositories\AbstractRepositoryInterface;

interface BrandProductRepositoryInterface extends AbstractRepositoryInterface
{
    public function statusChange($id, $brandStatus);
    public function getBand($idItem);
    public function getArrayNameProduct();
    public function getBrandFromCategory();
}
