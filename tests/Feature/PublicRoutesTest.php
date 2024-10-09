<?php


namespace Tests\Feature;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class PublicRoutesTest extends TestCase
{
    #[Test]
    public function home_page_is_accessible()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    #[Test]
    public function login_page_is_accessible()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    #[Test]
    public function register_page_is_accessible()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    #[Test]
    public function forgot_password_page_is_accessible()
    {
        $response = $this->get('/forgot-password');
        $response->assertStatus(200);
    }

    #[Test]
    public function contact_page_is_accessible()
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
    }
}
