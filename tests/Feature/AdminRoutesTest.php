<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class AdminRoutesTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    protected function setUp(): void
    {
        parent::setUp();

        // Création d'un administrateur
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $this->admin = User::factory()->create();
        $this->admin->assignRole($adminRole);
    }

    #[Test]
    public function admin_can_access_dashboard()
    {
        $response = $this->actingAs($this->admin)->get('/admin/dashboard');
        $response->assertStatus(200);
    }

    #[Test]
    public function non_admin_cannot_access_dashboard()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(403); // Accès interdit
    }

    // Ajoute des tests similaires pour les autres routes protégées (users, projects, etc.)
}
