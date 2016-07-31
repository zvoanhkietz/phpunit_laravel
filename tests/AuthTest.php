<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testUserLoginSuccess()
    {
        // create user to test
        factory(App\User::class)->create([
            'email'    => 'admin@testsys.com',
            'password' => bcrypt('123456'),
        ]);

        // make sure that user have been existed
        $this->seeInDatabase('users', ['email' => 'admin@testsys.com']);

        // Check login page display form is correct
        $this->visit('/login')
                ->see('Login')
                ->see('E-Mail Address')
                ->see('Password');

        // Test login user
        $this->type('admin@testsys.com', 'email')
                ->type('123456', 'password')
                ->press('Login');
        
        // Test login success
        $this->see('Your Application\'s Landing Page.');
    }

}