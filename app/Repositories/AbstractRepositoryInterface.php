<?php

namespace App\Repositories;

interface AbstractRepositoryInterface
{
    public function getAll($request);
    public function store($request, $today);
    public function edit($id);
    public function update($request, $id, $today);
    public function destroy($id, $today);
}
