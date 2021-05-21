<?php

namespace Tests\Feature;

use App\Models\{
    Task,
    User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup for test, makes sure there is
     * one user with two task belonging, and one
     * that belongs to another user
     *
     * @return void
     *
     */
    public function setUp(): void
    {
        parent::setUp();

        $user = new User();

        $user->username = "Ron";
        $user->email = "ron@hogwarts.com";
        $user->password = bcrypt("test");
        $user->save();

        session()->put('user', $user);

        $task = new Task();
        $task->title = "Lesson 1";
        $task->body = "Magical beasts and where to find them with Hagrid";
        $task->user_id = $user->id;
        $task->save();

        $task = new Task();
        $task->title = "Lesson 2";
        $task->body = "Defense against dark arts with Gyllenroy";
        $task->user_id = $user->id;
        $task->save();

        $task = new Task();
        $task->title = "Lesson 3";
        $task->body = "Potions with Snape";
        $task->user_id = $user->id + 1;
        $task->save();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     *
     */
    public function testNotLoggedIn()
    {
        session()->flush();

        $responseNoUser = $this->get('/tasks');
        $responseNoUser->assertStatus(403)
            ->assertSee("You are not logged in");
    }

    public function testShowTasks()
    {
        $response = $this->get('/tasks');

        $response->assertStatus(200)
            ->assertSee("Lesson 1")
            ->assertSee("Lesson 2")
            ->assertDontSee("Lesson 3");
    }

    /**
     * Test.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function testShowOneTask()
    {
        /** @phpstan-ignore-next-line */
        $task = Task::first();
        $taskId = $task->id;

        $response = $this->get('/task' . '/' . $taskId);

        $response->assertStatus(200)
            ->assertSee("Lesson 1");

        /** @phpstan-ignore-next-line */
        $taskNotMine = Task::find($taskId + 2);
        $taskNotMineId = $taskNotMine->id;

        $response = $this->get('/task' . '/' . $taskNotMineId);

        $response->assertStatus(403)
            ->assertSee("You are not authorized to see this task");
    }

    /**
     * A basic feature test example.
     *
     * @return void
     *
     */
    public function testShowFinishedTasks()
    {
        $userId = session()->get('user')->id;

        $task = new Task();
        $task->title = "Lesson 5";
        $task->body = "Quidditch with Madame Hooch";
        $task->user_id = $userId;
        $task->save();

        $task->done();

        $response = $this->get('/finished-tasks');

        $response->assertStatus(200)
            ->assertSee("Lesson 5")
            ->assertDontSee("Lesson 1");
    }

    /**
     * A basic feature test example.
     *
     * @return void
     *
     */
    public function testAddTaskForm()
    {
        $response = $this->get('/add-task');

        $response->assertStatus(200)
            ->assertSee("Add task");
    }

    public function testAddTask()
    {
        $response = $this->post('/add-task', [
            'title' => 'Lesson 5',
            'body' => "Quidditch with Madame Hooch"]);

        $response->assertStatus(302) // redirect
            ->assertRedirect('/tasks');
        $this->followRedirects($response)
            ->assertSee("Add a new task")
            ->assertSee("Lesson 5");
    }

    /**
     * Test.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function testUpdateTaskForm()
    {
        /** @phpstan-ignore-next-line */
        $task = Task::first();
        $taskId = $task->id;

        $response = $this->get('/task' . '/' . $taskId . '/update');

        $response->assertStatus(200)
            ->assertSee("Save update");
    }

    /**
     * Test.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function testUpdateTask()
    {
        /** @phpstan-ignore-next-line */
        $task = Task::first();
        $taskId = $task->id;

        $response = $this->post('/task' . '/' . $taskId . '/update', [
            'title' => 'Lesson 1 Updated',
            'body' => $task->body]);

        $response->assertStatus(302) // redirect
            ->assertRedirect('/tasks');
        $this->followRedirects($response)
            ->assertSee("Lesson 1 Updated");
    }

    /**
     * Test.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function testTaskDone()
    {
        /** @phpstan-ignore-next-line */
        $task = Task::first();
        $taskId = $task->id;

        $response = $this->get('/task' . '/' . $taskId . '/done');

        $response->assertStatus(302) // redirect
            ->assertRedirect('/finished-tasks');
        $this->followRedirects($response)
            ->assertSee("Lesson 1");
    }

    /**
     * Test.
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function testTaskDelete()
    {
        /** @phpstan-ignore-next-line */
        $task = Task::first();
        $taskId = $task->id;

        $response = $this->get('/task' . '/' . $taskId . '/delete');

        $response->assertStatus(302) // redirect
            ->assertRedirect('/tasks');

        $this->followRedirects($response)
            ->assertDontSee("Lesson 1");

        $this->assertDatabaseCount('tasks', 2);
    }
}
