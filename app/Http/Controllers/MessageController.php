<?php

namespace App\Http\Controllers;

use App\Contracts\IMessageRepository;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(
        private IMessageRepository $repository
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        return $this->repository->find($message);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        return $this->repository->update($request, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        return $this->repository->delete($message);
    }
}
