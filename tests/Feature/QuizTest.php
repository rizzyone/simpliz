<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Quiz;
use App\Models\User;
use Tests\Utils\Auth as TestUtilAuth;
use Tests\Utils\Seeder as TestUtilSeeder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuizTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Collection $quizzes;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->quizzes = Quiz::factory()->count(2)->create();

        foreach ($this->quizzes as $quiz) {
            TestUtilSeeder::seedQuizContent($quiz);
        }

        $this->user->quizzes()->save($this->quizzes[0]);
    }

    public function test_user_can_see_quiz_detail()
    {
        $assignedQuiz = $this->quizzes->get(0);

        TestUtilAuth::userLogin($this, $this->user);

        $response = $this->get('/quizzes/' . $assignedQuiz->id);

        $response->assertStatus(200);
        $quizResponse = $response['quiz'];

        $this->assertEquals($assignedQuiz->name, $quizResponse->name);
        $this->assertEquals($assignedQuiz->description, $quizResponse->description);
    }

    public function test_unauthenticated_user()
    {
        $assignedQuiz = $this->quizzes->get(0);

        $response = $this->get('/quizzes/' . $assignedQuiz->id);
        $response->assertStatus(302);
    }

    public function test_unassigned_user()
    {
        $unnasignedQuiz = $this->quizzes->get(1);
        
        TestUtilAuth::userLogin($this, $this->user);

        $response = $this->get('/quizzes/' . $unnasignedQuiz->id);
        $response->assertStatus(404);
    }
}
