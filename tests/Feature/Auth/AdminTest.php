<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_can_change_user_admin_status()
{
    // Create an admin user and a regular user
    $admin = User::factory()->create(['is_admin' => true]);
    $user = User::factory()->create(['is_admin' => false]);

    // Authenticate as the admin
    $this->actingAs($admin);

    // Send a request to change the regular user to an admin
    $response = $this->patch(route('admin.users.update', $user->id), [
        'name' => $user->name,
        'email' => $user->email,
        'is_admin' => true,
    ]);

    // Assert the response status
    $response->assertRedirect();
    $response->assertSessionHas('success', 'User updated successfully.');

    // Refresh the user model and assert the changes
    $user->refresh();
    $this->assertTrue($user->is_admin);
}

}
