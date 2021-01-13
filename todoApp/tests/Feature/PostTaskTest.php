<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTaskTest extends TestCase
{
    use RefreshDatabase; // ①データベースをリセット

    public function testPostTask()
    {
        $name = 'new task';

        $response = $this->postJson('/api/tasks', [  // ②JSON を POST
            'name' => $name,
        ]);

        $id = $response->json(['id']);

        $response->assertStatus(201);  // ③レスポンスの検証
        $response->assertJson([
            'id' => $id,
            'name' => $name,
        ]);

        $this->assertDatabaseHas('tasks', [ // ④データベースの検証
            'id' => $id,
            'name' => $name,
        ]);
    }
}
