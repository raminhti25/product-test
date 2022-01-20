<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\CreateProductRequest;
use App\Interfaces\ProductRepositoryInterface;

class ProductController extends Controller
{
    private $repository;

    /**
     * ProductController constructor.
     * @param ProductRepositoryInterface $repository
     */
    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * @param CreateProductRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $product = $this->repository->store($request->all());

        return response(['data' => new ProductResource($product), 'message' => trans('message.created')], 201);
    }

    /**
     * @param UpdateProductRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, int $id)
    {
        $product = $this->repository->show($id);

        $this->repository->update($product, $request->all());

        return response(['message' => trans('messages.updated')]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $id)
    {
        $product = $this->repository->show($id);

        $this->repository->destroy($product);

        return response()->noContent();
    }
}
