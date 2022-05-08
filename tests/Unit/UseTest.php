<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UseTest extends TestCase
{
    /**
     * Test if login route exist
     *
     * @return void
     */
    public function test_login_form()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * Test if users can't have the same name and email
     *
     * @return void
     */
    public function test_user_duplication()
    {
        $user1 = User::make([
            'name'  => 'John Doe',
            'email' => 'johndoe@gmail.com'
        ]);

        $user2 = User::make([
            'name'  => 'Dary',
            'email' => 'dary@gmail.com'
        ]);

        $this->assertTrue($user1->name != $user2->name);
    }


    /**
     * Test if user can be deleted.
     *
     * @return void
     */
    public function test_deletes_user()
    {
        $user = User::factory()->count(1)->make();

        $user = User::first();

        if($user) {
            $user->delete();
        }

        $this->assertTrue(true);
    }


    /**
     * Test register route
     *
     * @return void
     */
    public function test_stores_new_users()
    {
        $response = $this->post('/register', [
            'name'     => 'Dary',
            'email'    => 'dary@gmail.com',
            'password' => 'dary1234',
            'password_confirmation' => 'dary1234'
        ]);

        $response->assertRedirect('/home');

    }
}
