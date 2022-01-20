<?php

namespace App\Interfaces;


interface ProductRepositoryInterface
{
    public function index();
    public function show(int $id);
    public function store(array $data);
    public function update($product, array $data);
    public function destroy($product);
}