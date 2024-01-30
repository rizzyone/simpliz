<?php

namespace App\Services;

use App\Data\CreateQuizDto;
use App\Models\Proctor;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface QuizService
{
    /**
     * @return LengthAwarePaginator<Quiz>
     */
    public function getPaginated(User $user, ?string $search, ?int $page, ?int $limit): LengthAwarePaginator;

    public function create(CreateQuizDto $data, Proctor $creator): Quiz;

    public function get(Quiz $quiz, User $user);
}
