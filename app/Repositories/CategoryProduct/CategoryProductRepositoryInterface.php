<?php

namespace App\Repositories\CategoryProduct;

use App\Repositories\AbstractRepositoryInterface;

interface CategoryProductRepositoryInterface extends AbstractRepositoryInterface
{
    public function activeCategory($id);
    public function unactiveCategory($id);
    public function getCategory($idBrand);
    public function getArrayNameCategoryProduct();
}