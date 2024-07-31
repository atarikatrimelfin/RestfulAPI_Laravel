<?php

namespace Tests\Feature;

use App\Models\ToDo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ToDoControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_read_data()
    {
        $email = 'atarikaaaa@gmail.com';
        $password = 'ata123';

        $response = $this->post('/api/login', [
            'email' => $email,
            'password' => $password,
        ]);
        $this->assertAuthenticated();

        $response = $this->getJson('/api/index');

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'title',
                    'description',
                    'status',
                    'priority',
                    'due_date',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }

    public function test_user_can_create_data_with_valid_credentials()
    {
        $email = 'atarikaaaa@gmail.com';
        $password = 'ata123';

        $response = $this->post('/api/login', [
            'email' => $email,
            'password' => $password,
        ]);
        $this->assertAuthenticated();

        $response = $this->postJson('/api/create', [
            'title' => "Web Project",
            'description' => "Make RestfulAPI Using Laravel",
            'status' => 'In Progress',
            'priority' => 'High',
            'due_date' => '2024-08-02',

        ]);
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Created Data Success',
            ]);
    }

    public function test_user_can_create_data_with_invalid_credentials()
    {
        $email = 'atarikaaaa@gmail.com';
        $password = 'ata123';

        $response = $this->post('/api/login', [
            'email' => $email,
            'password' => $password,
        ]);
        $this->assertAuthenticated();

        $response = $this->postJson('/api/create', [
            'id' => 5,
            'title' => "Web Project",
            'description' => "Make RestfulAPI Using Laravel",
            'status' => 'In Progres', //Invalid status
            'priority' => 'High',
            'due_date' => '2024-08-02',

        ]);
        $response->assertStatus(422)
            ->assertJson([
                'success' => false,
                'message' => 'Created Data Failed',
            ]);
    }

    public function test_user_can_update_data_with_valid_credentials()
    {
        $email = 'atarikaaaa@gmail.com';
        $password = 'ata123';

        $response = $this->post('/api/login', [
            'email' => $email,
            'password' => $password,
        ]);
        $this->assertAuthenticated();

        $todo = ToDo::create([
            'title' => 'Initial',
            'description' => 'Initial Description',
            'status' => 'Pending',
            'priority' => 'Low',
            'due_date' => '2024-01-01',
        ]);

        $updateData = [
            'title' => 'Updated',
            'description' => 'Updated Description',
            'status' => 'Completed',
            'priority' => 'High',
            'due_date' => '2024-12-31',
        ];

        $response = $this->putJson('/api/update/' . $todo->id, $updateData);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Updated Data Success',
            ]);

        $this->assertDatabaseHas('todo', [
            'id' => $todo->id,
            'title' => 'Updated',
            'description' => 'Updated Description',
            'status' => 'Completed',
            'priority' => 'High',
            'due_date' => '2024-12-31',
        ]);
    }

    public function test_user_can_update_data_with_invalid_credentials()
    {
        $email = 'atarikaaaa@gmail.com';
        $password = 'ata123';

        $response = $this->post('/api/login', [
            'email' => $email,
            'password' => $password,
        ]);
        $this->assertAuthenticated();

        $todo = ToDo::create([
            'title' => 'Initial Title',
            'description' => 'Initial Description',
            'status' => 'Pending',
            'priority' => 'Low',
            'due_date' => '2024-01-01',
        ]);

        $updateData = [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'status' => '', // Status not valid
            'priority' => 'High',
            'due_date' => '2024-12-31',
        ];

        $response = $this->putJson('/api/update/' . $todo->id, $updateData);

        $response->assertStatus(422)
            ->assertJson([
                'success' => false,
                'message' => 'Updated Data Failed',
            ]);

        $this->assertDatabaseHas('todo', [
            'id' => $todo->id,
            'title' => 'Initial Title',
            'description' => 'Initial Description',
            'status' => 'Pending',
            'priority' => 'Low',
            'due_date' => '2024-01-01',
        ]);
    }
}
