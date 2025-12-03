<?php

use App\Livewire\Auth\Register;
use App\Models\User; // Asegúrate de importar esto
use Livewire\Livewire;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register using livewire component', function () {
    $response = Livewire::test(Register::class)
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register');

    $response
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false)); 

    $this->assertAuthenticated();
});

test('new users can register using the standard post request (modal)', function () {
    // Este test verifica que tu modal funcione
    $response = $this->post('/register', [
        'name' => 'Test User Modal',
        'email' => 'test-modal@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
    
    // Verificamos que se creó en la BBDD
    $this->assertDatabaseHas('users', [
        'email' => 'test-modal@example.com',
    ]);
});