<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_hello_route_displays_the_name(): void
    {
        $this->get('/hello/Fahad')
            ->assertOk()
            ->assertSee('Hello, Fahad');
    }

    public function test_the_about_route_is_served_by_the_controller(): void
    {
        $this->get('/about')
            ->assertOk()
            ->assertSee('<h1>About</h1>', false);
    }

    public function test_students_can_be_listed_and_viewed(): void
    {
        $student = Student::create([
            'roll_no' => 'CS23-99',
            'name' => 'Test Student',
            'email' => 'test.student@example.com',
            'department' => 'CSE',
            'semester' => 7,
            'cgpa' => 8.50,
        ]);

        $this->get('/students')
            ->assertOk()
            ->assertSee('CS23-99')
            ->assertSee('Test Student');

        $this->get("/students/{$student->id}")
            ->assertOk()
            ->assertSee('Test Student');
    }

    public function test_student_can_be_created_from_the_form(): void
    {
        $this->get('/students/create')->assertOk()->assertSee('Add New Student');

        $response = $this->post('/students', [
            'roll_no' => 'CS23-100',
            'name' => 'New Student',
            'email' => 'new.student@example.com',
            'department' => 'CSE',
            'semester' => 7,
            'cgpa' => 9.10,
        ]);

        $response->assertRedirect('/students');
        $response->assertSessionHas('status', 'Student saved successfully!');
        $this->assertDatabaseHas('students', [
            'roll_no' => 'CS23-100',
            'email' => 'new.student@example.com',
        ]);

        $this->get('/students')
            ->assertOk()
            ->assertSee('Student saved successfully!');
    }

    public function test_student_id_and_roll_bindings_return_students_or_404(): void
    {
        $student = Student::create([
            'roll_no' => 'CS23-73',
            'name' => 'Fahad M K',
            'email' => 'fahad.m.k@example.com',
            'department' => 'CSE',
            'semester' => 7,
            'cgpa' => 7.78,
        ]);

        $this->get("/students/{$student->id}")
            ->assertOk()
            ->assertSee('Fahad M K');

        $this->get('/students/999999')->assertNotFound();

        $this->get('/roll/CS23-73')
            ->assertOk()
            ->assertSee('Fahad M K');

        $this->get('/roll/73')
            ->assertOk()
            ->assertSee('Fahad M K');

        $this->get('/roll/999999')->assertNotFound();
    }

    public function test_students_api_returns_json(): void
    {
        Student::create([
            'roll_no' => 'CS23-73',
            'name' => 'Fahad M K',
            'email' => 'fahad.m.k@example.com',
            'department' => 'CSE',
            'semester' => 7,
            'cgpa' => 7.78,
        ]);

        $this->getJson('/api/students')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonPath('0.roll_no', 'CS23-73');
    }
}
