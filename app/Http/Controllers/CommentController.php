<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentCollection;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Interfaces\ProductRepositoryInterface;
use App\Repositories\Eloquent\CommentRepository;

class CommentController extends Controller
{
    private $repository;

    /**
     * ProductController constructor.
     * @param CommentRepository $repository
     */
    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comments = $this->repository->index($request->all());

        return response(new CommentCollection($comments));
    }

    /**
     * @param CreateCommentRequest $request
     * @param int $product_id
     * @param ProductRepositoryInterface $product_repository
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(
        CreateCommentRequest $request,
        int $product_id,
        ProductRepositoryInterface $product_repository
    ) {
        $product = $product_repository->show($product_id);

        $response = Gate::inspect('create', [Comment::class, $product]);

        if (!$response->allowed()) {
            return $response->message();
        }

        $request->request->add(['product_id' => $product_id, 'user_id' => 0]);

        $comment = $this->repository->store($request->all());

        return response(['data' => new CommentResource($comment), 'message' => trans('messages.created')], 201);
    }

    /**
     * @param UpdateCommentRequest $request
     * @param int $product_id
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, int $product_id, int $id)
    {
        //TODO check comment belongs to product

        $comment = $this->repository->show($id);

        $this->repository->update($comment, $request->all());

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
        $comment = $this->repository->show($id);

        $this->repository->destroy($comment);

        return response()->noContent();
    }
}
