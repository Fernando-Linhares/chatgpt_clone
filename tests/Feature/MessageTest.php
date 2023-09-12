<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{ User, Message };


class MessageTest extends TestCase
{
    use RefreshDatabase;

    /**
    * @test
    */
    public function should_be_ok_when_get_all_messages()
    {
        $this->actingAs(User::factory()->create())
            ->get('/api/messages')
            ->assertStatus(200);
    }

    /**
     *
     * @test
     */
    public function should_be_ok_store_some_message()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
        ->post('/api/messages', ['user_id' => $user->id, 'content' => 'TEST CONTENT'])
        ->assertStatus(201);
    }

    /**
     *
     * @test
     */
    public function should_be_ok_update_some_message()
    {
        $user = User::factory()->create();

        $message = Message::create(['user_id'=>$user->id, 'content' => 'NOT TEST CONTENT']);

        $this->actingAs($user)
        ->put('/api/messages/'.$message->id, ['user_id' => $user->id, 'content' => 'TEST CONTENT'])
        ->assertStatus(200);
    }

    /**
     *
     * @test
     */
    public function should_be_ok_delete_some_message()
    {
        $user = User::factory()->create();

        $message = Message::create(['user_id'=> $user->id, 'content' => 'NOT TEST CONTENT']);

        $this->actingAs($user)
        ->delete('/api/messages/'.$message->id)
        ->assertStatus(200);
    }
}
