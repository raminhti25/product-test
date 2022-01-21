<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use App\Http\Resources\VoteResource;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\VoteCollection;
use App\Http\Requests\CreateVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
use App\Interfaces\VoteRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;

class VoteController extends Controller
{
    private $repository;

    /**
     * ProductController constructor.
     * @param VoteRepositoryInterface $repository
     */
    public function __construct(VoteRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $votes = $this->repository->index($request->all());

        return response(new VoteCollection($votes));
    }

    /**
     * @param CreateVoteRequest $request
     * @param int $product_id
     * @param ProductRepositoryInterface $product_repository
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(CreateVoteRequest $request, int $product_id, ProductRepositoryInterface $product_repository)
    {
        $product = $product_repository->show($product_id);

        $response = Gate::inspect('create', [Vote::class, $product]);

        if (!$response->allowed()) {
            return $response->message();
        }

        $request->request->add(['product_id' => $product_id, 'user_id' => 0]);

        $vote = $this->repository->store($request->all());

        return response(['data' => new VoteResource($vote), 'message' => trans('messages.created')], 201);
    }

    /**
     * @param UpdateVoteRequest $request
     * @param int $product_id
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoteRequest $request, int $product_id, int $id)
    {
        //TODO check vote belongs to product

        $vote = $this->repository->show($id);

        $this->repository->update($vote, $request->all());

        //TODO don't let user change status

        return response(['message' => trans('messages.updated')]);
    }

    /**
     * @param Request $request
     * @param int $product_id
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, int $product_id, int $id)
    {
        $vote = $this->repository->show($id);

        $this->repository->destroy($vote);

        return response()->noContent();
    }
}
