<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\VoteResource;
use App\Http\Requests\CreateVoteRequest;
use App\Http\Requests\UpdateVoteRequest;
use App\Interfaces\VoteRepositoryInterface;

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
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * @param CreateVoteRequest $request
     * @param int $product_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(CreateVoteRequest $request, int $product_id)
    {
        $data = $request->all();

        //TODO check if user can vote

        $vote = $this->repository->store(array_merge($data, ['product_id', $product_id]));

        return response(['data' => new VoteResource($vote), 'message' => trans('message.created')], 201);
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
