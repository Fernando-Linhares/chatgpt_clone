<?php

namespace App\Repositories;

use App\Contracts\IMessageRepository;
use App\Models\{ Message, User };
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MessageRepository implements IMessageRepository
{
    public function __construct(private Message $message){}

     /**
     * Should return all collection of messages
     *
     * @return Illuminate\Database\Eloquent\Collection<Message>
     */
    public function all(): Collection
    {
        return $this->message->all();
    }

    /**
     * Should return some message
     *
     * @param \App\Models\Message $message
     * @return \App\Models\Message
     */
    public function find(Message $message): Message
    {
        return $message;
    }

    /**
     * Should delete some message
     *
     * @param \App\Models\Message $message
     * @return boolean
     */
    public function delete(Message $message): bool
    {
        return $message->delete();
    }

    /**
     * Should update some message
     *
     * @param \App\Models\Message $message
     * @param \Illuminate\Http\Request $request
     * @return  \App\Models\Message
     */
    public function update(Request $request, Message $message): Message
    {
        if($message->update($request->all()))
            return $message;

        return $message;
    }


    /**
     * Should store the message sended
     *
     * @param Illuminate\Http\Request $request
     * @return \App\Models\Message
     */
    public function store(Request $request): Message
    {
        $message = $this->message->create($request->all());

        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'authorization' => 'Bearer '. env('GPT_KEY')
        ])
        ->post('https://api.openai.com/v1/chat/completions',[
            'model'=>'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $message->content
                ]
            ],
            'temperature'=> 0.7
        ]);

        $result = $response->json();

        if(key_exists('error', $result))
            return $this->message->create([
                'user_id' => $request->user()->id,
                'assistent'=> true,
                'content' => $result['error']['message']
            ]);

        return $this->message->create([
            'user_id' => $request->user()->id,
            'assistent'=> true,
            'content' => $result['choices'][0]['content']
        ]);
    }

    /**
     * Should return all messages by user
     *
     * @param \App\Models\User $user
     * @return Illuminate\Database\Eloquent\Collection<Message>
     */
    public function findByUser(User $user): Collection
    {
        return $user->messages;
    }

    /**
     * Should return all messages by datetime
     *
     * @param \DateTime $dateTime
     * @return Illuminate\Database\Eloquent\Collection<Message>
     */
    public function findByDateTime(\DateTime $dateTime): Collection
    {
        return $this->message->where('created_at', $dateTime->format('d-m-Y H:i:s'))->get();
    }
}
