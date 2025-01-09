<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Sport;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    private function login(string $email = "test@example.com", string $password = "123")
    {
        //Bejelentkezés
        $response = $this
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->postJson('/api/users/login', [
                'email' => $email,
                'password' => $password
            ]);

        $token = $response->json('data')['token'];
        // dd($token);
        return $token;
    }
    public function test_login(): void
    {
        // Csinálunk egy user-t
        //Csinálok egy user-t
        $name = 'test99';
        $email = 'test99@example.com';
        $password = '123';

        $user = User::factory()->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        //loge d ind-3l,
        $response = $this
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->postJson('/api/users/login', data: [
                'email' => $email,
                'password' => $password
            ]);

        $response->assertStatus(200);
        $token = $response->json('data')['token'];
        $this->assertNotNull($token);


        // da320lä@Đd, dl jijds012
        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ])
            ->get('/api/users');
        $response->assertStatus(200);
        // dd($response);
    }
    public function test_sport_create()
    {
        $token = $this->login();
        $sportNev = '111';
        $response = $this
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ])
            ->postJson('/api/sports', [
                "sportNev" => $sportNev
            ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('sports', ['sportNev' => $sportNev]);
        $sport = Sport::where('sportNev', $sportNev)->first();
        // dd($sport);
        $this->assertNotNull($sport);

    }
}
