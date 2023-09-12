<?php

namespace App\Contracts;

use App\Models\{ Message, User };
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface IMessageRepository
{
    /**
     * Should return all collection of messages
     *
     * @return Illuminate\Database\Eloquent\Collection<Message>
     */
    public function all(): Collection;

    /**
     * Should return some message
     *
     * @param \App\Models\Message $message
     * @return \App\Models\Message
     */
    public function find(Message $message): Message;

    /**
     * Should delete some message
     *
     * @param \App\Models\Message $message
     * @return boolean
     */
    public function delete(Message $message): bool;

    /**
     * Should update some message
     *
     * @param \App\Models\Message $message
     * @param \Illuminate\Http\Request
     * @return  \App\Models\Message
     */
    public function update(Request $request, Message $message): Message;


    /**
     * Should store the message sended
     *
     * @param Illuminate\Http\Request
     * @return \App\Models\Message
     */
    public function store(Request $request): Message;

    /**
     * Should return all messages by user
     *
     * @param \App\Models\User $user
     * @return Illuminate\Database\Eloquent\Collection<Message>
     */
    public function findByUser(User $user): Collection;

    /**
     * Should return all messages by datetime
     *
     * @param \DateTime $dateTime
     * @return Illuminate\Database\Eloquent\Collection<Message>
     */
    public function findByDateTime(\DateTime $dateTime): Collection;
}
