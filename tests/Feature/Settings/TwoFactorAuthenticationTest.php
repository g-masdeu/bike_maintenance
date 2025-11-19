<?php

namespace Tests\Feature\Settings;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @covers \App\Livewire\Settings\TwoFactor
 */
class TwoFactorAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh');
    }

    public function test_two_factor_settings_page_can_be_rendered(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'two_factor_secret' => null,
            'two_factor_confirmed' => false,
        ]);

        $response = $this->actingAs($user)
            ->withSession(['auth.password_confirmed_at' => time()])
            ->get(route('two-factor.show'));

        $response->assertOk()
            ->assertSee('Autenticación de dos factores')
            ->assertSee('Disabled');
    }

    public function test_two_factor_settings_page_requires_password_confirmation_when_enabled(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'two_factor_secret' => encrypt(random_bytes(32)),
            'two_factor_confirmed' => true,
        ]);

        $response = $this->actingAs($user)
            ->get(route('two-factor.show'));

        $response->assertRedirect('/user/confirm-password');
    }

    public function test_two_factor_settings_page_returns_forbidden_response_when_two_factor_is_disabled(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'two_factor_secret' => null,
        ]);

        $component = Livewire::test(\App\Livewire\Settings\TwoFactor::class)
            ->actingAs($user)
            ->withSession(['auth.password_confirmed_at' => time()]);

        $component->call('disable')
            ->assertStatus(403);
    }

    public function test_two_factor_authentication_disabled_when_confirmation_abandoned_between_requests(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'two_factor_secret' => encrypt(random_bytes(32)),
            'two_factor_confirmed' => false,
        ]);

        $this->actingAs($user)
            ->withSession(['auth.password_confirmed_at' => null])
            ->get(route('two-factor.show'));

        // CORRECCIÓN: Usa refresh() en lugar de fresh() para evitar el warning de Intelephense
        $user->refresh();
        $this->assertNull($user->two_factor_secret);
    }
}