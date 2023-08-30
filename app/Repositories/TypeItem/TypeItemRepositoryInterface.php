<?php

namespace App\Repositories\TypeItem;

use App\Repositories\AbstractRepositoryInterface;

interface TypeItemRepositoryInterface extends AbstractRepositoryInterface
{
    public function statusChange($id, $itemStatus);
}
