<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexNoUser()
    {
        $response = $this->get('/welcome');

        $response->assertStatus(200)
            ->assertSee("Welcome to this ToDo application!");
    }

    public function testLogin()
    {
        $user = new User();

        $user->username = "Ron";
        $user->email = "ron@hogwarts.com";
        $user->password = bcrypt("test");
        $user->save();

        $this->assertDatabaseCount('users', 1);

        // successful login
        $response = $this->followingRedirects() // redirect
            ->post('/login', [
                'email' => 'ron@hogwarts.com',
                'password' => "test"])
            ->assertStatus(200);

        // unsuccessful login due to user doesn't exist
        $response = $this->followingRedirects() // redirect
            ->post('/login', [
                'email' => 'nope@hogwarts.com',
                'password' => "test"])
            ->assertStatus(200)
            ->assertSee("Welcome to this ToDo application!");

        // unsuccessful login due to wrong password
        $response = $this->followingRedirects() // redirect
            ->post('/login', [
                'email' => 'ron@hogwarts.com',
                'password' => "Test"])
            ->assertStatus(200)
            ->assertSee("Welcome to this ToDo application!");
    }

    public function testRegisterForm()
    {
        $response = $this->get('/register');

        $response->assertStatus(200)
            ->assertSee("Create new account");
    }

    public function testRegister()
    {
        // successful registration
        $response = $this->post('/register', [
            'email' => 'ron@hogwarts.com',
            'password' => "test",
            'username' => "Ron"]);

        $response->assertStatus(302) // redirect
                ->assertRedirect('/tasks');
        $this->followRedirects($response)->assertSee("Add a new task");
        $this->assertDatabaseCount('users', 1);

        // unsuccessful registration, taken email
        $responseTakenEmail = $this->post('/register', [
            'email' => 'ron@hogwarts.com',
            'password' => "test",
            'username' => "Hermione"]);

        $responseTakenEmail->assertStatus(403) // redirect
            ->assertSee("Email already taken");
        $this->assertDatabaseCount('users', 1);
    }

    public function testLogout()
    {
        $response = $this->get('/logout');

        $response->assertStatus(302)
            ->assertRedirect('/welcome');

        $this->followRedirects($response)->assertSee("Welcome to this ToDo application!");
    }
}
