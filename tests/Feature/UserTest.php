<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $user = new User();

        $user->username = "Test Person";
        $user->email = "email@email.com";
        $user->password = bcrypt("test");
        $user->save();

        $this->assertDatabaseCount('users', 1);
    }

    public function testCheckUser()
    {
        $user = new User();

        $user->username = "Test Person";
        $user->email = "email@email.com";
        $user->password = bcrypt("test");
        $user->save();

        $result = $user->checkUser("email@email.com", "test");
        $expected = "email@email.com";

        $result2 = $user->checkUser("faultyemail@email.com", "test");

        $result3 = $user->checkUser("email@email.com", "wrongpassword");

        $this->assertEquals($expected, $result->email);
        $this->assertEquals($result2, null);
        $this->assertEquals($result3, null);
    }
}
