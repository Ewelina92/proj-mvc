<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creation of a new task.
     *
     * @return void
     */
    public function testCreateTask()
    {
        $task = new Task();

        $task->title = "This is a title";
        $task->body = "This is the body";
        $task->user_id = 1;
        $task->save();

        $this->assertDatabaseCount('tasks', 1);
    }

    /**
     * Test marking a task as finished.
     *
     * @return void
     */
    public function testDone()
    {
        $task = new Task();

        $task->title = "This is a title";
        $task->body = "This is the body";
        $task->user_id = 1;
        $task->save();

        $result = $task->finished_at;
        $expected = null;

        $task->done();

        $result2 = $task->finished_at;

        $this->assertNotNull($result2);
        $this->assertEquals($expected, $result);
    }

    /**
     * Test updating a task.
     *
     * @return void
     */
    public function testUpdateTask()
    {
        $task = new Task();

        $task->title = "This is a title";
        $task->body = "This is the body";
        $task->user_id = 1;
        $task->save();

        $task->updateTask("New title", "New body");

        $resultTitle = $task->title;
        $resultBody = $task->body;

        $expectedTitle = "New title";
        $expectedBody = "New body";

        $this->assertEquals($expectedTitle, $resultTitle);
        $this->assertEquals($expectedBody, $resultBody);
    }
}
