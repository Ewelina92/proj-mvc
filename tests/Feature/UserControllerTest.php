<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test access to /welcome when not logged in.
     *
     * @return void
     */
    public function testIndexNoUser()
    {
        $response = $this->get('/welcome');

        $response->assertStatus(200)
            ->assertSee("Welcome to this ToDo application!");
    }

    /**
     * Test login function.
     *
     * @return void
     */
    public function testLogin()
    {
        $user = new User();

        $user->username = "Ron";
        $user->email = "ron@hogwarts.com";
        $user->password = bcrypt("test");
        $user->save();

        $this->assertDatabaseCount('users', 1);

        // unsuccessful login due to user doesn't exist
        $this->followingRedirects() // redirect
            ->post('/login', [
                'email' => 'nope@hogwarts.com',
                'password' => "test"])
            ->assertStatus(200)
            ->assertSee("Welcome to this ToDo application!");

        //unsuccessful login due to wrong password
        $this->followingRedirects() // redirect
            ->post('/login', [
                'email' => 'ron@hogwarts.com',
                'password' => "Test"])
            ->assertStatus(200)
            ->assertSee("Welcome to this ToDo application!");


        // successful login
        $this->followingRedirects() // redirect
            ->post('/login', [
                'email' => 'ron@hogwarts.com',
                'password' => "test"])
            ->assertStatus(200);
    }

    /**
     * Test access to /register when not logged in.
     *
     * @return void
     */
    public function testRegisterForm()
    {
        $response = $this->get('/register');

        $response->assertStatus(200)
            ->assertSee("Create new account");
    }

    /**
     * Test register function.
     *
     * @return void
     */
    public function testRegister()
    {
        // successful registration
        $this->followingRedirects() // redirect
            ->post('/register', [
                'email' => 'ron@hogwarts.com',
                'password' => "test",
                'username' => "Ron"])
            ->assertStatus(200)
            ->assertSee("Add a new task");
        $this->assertDatabaseCount('users', 1);

        // unsuccessful registration, taken email
        $this->followingRedirects() // redirect
            ->post('/register', [
                'email' => 'ron@hogwarts.com',
                'password' => "test",
                'username' => "Hermione"])
            ->assertStatus(403)
            ->assertSee("Email already taken");
        $this->assertDatabaseCount('users', 1);
    }

    /**
     * Test logout function.
     *
     * @return void
     */
    public function testLogout()
    {
        $this->followingRedirects() // redirect
            ->get('/logout')
            ->assertStatus(200)
            ->assertSee("Welcome to this ToDo application!");
    }
}
