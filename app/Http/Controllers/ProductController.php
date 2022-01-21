<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Interfaces\VoteRepositoryInterface;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\CreateProductRequest;
use App\Interfaces\CommentRepositoryInterface;
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
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->repository->index($request->all());

        return response(new ProductCollection($products));
    }

    /**
     * @param Request $request
     * @param int $id
     * @param CommentRepositoryInterface $comment_repository
     * @param VoteRepositoryInterface $vote_repository
     * @return array
     */
    public function show(
        Request $request,
        int $id,
        CommentRepositoryInterface $comment_repository,
        VoteRepositoryInterface $vote_repository
    ) {
        $product = $this->repository->show($id);

        $params = [
            'comments' => $comment_repository->getProductComments($id, ['limit' => 3]),
            'votes_average' => $vote_repository->averageVote($id),
            'total_comments' => $comment_repository->getProductTotalComments($id),
        ];

        return response(['data' => new ProductResource($product, $params)]);
    }

    /**
     * @param CreateProductRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $product = $this->repository->store($request->all());

        return response(['data' => new ProductResource($product), 'message' => trans('messages.created')], 201);
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
