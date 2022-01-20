<?php

namespace App\Interfaces;


interface ProductRepositoryInterface
{
    public function index(array $data);
    public function show(int $id);
    public function store(array $data);
    public function update($product, array $data);
    public function destroy($product);
}