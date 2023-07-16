<?php

declare(strict_types=1);

namespace Src\Subject\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Src\Subject\Application\AssignProjectToSubject;
use Src\Subject\Application\CreateSubjectUseCase;
use Src\Subject\Application\FilterSubjectsUseCase;
use Src\Subject\Domain\Contracts\SubjectRepositoryContract;
use Symfony\Component\HttpFoundation\Response;

class SubjectController extends Controller
{
    private SubjectRepositoryContract $repository;

    public function __construct(SubjectRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int     $repositoryID
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function createSubject(Request $request, int $repositoryID): \Illuminate\Http\JsonResponse
    {
        // Could also be created a CreateSubjectRequest alternatively...
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            // Add more validation rules as per your requirements
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $validatedData = $validator->validated();
            $createSubjectUseCase = new CreateSubjectUseCase($this->repository);
            $createSubjectUseCase($repositoryID, $validatedData['name']);

            return response()->json(['message' => 'Subject created successfully.'], Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @param int $repositoryID
     * @param int $subjectID
     * @param int $projectID
     *
     * @return JsonResponse
     */
    public function assignProjectToSubject(int $repositoryID, int $subjectID, int $projectID): \Illuminate\Http\JsonResponse
    {
        try {
            $assignProjectToSubjectUseCase = new AssignProjectToSubject($this->repository);
            $assignProjectToSubjectUseCase($repositoryID, $subjectID, $projectID);

            return response()->json(['message' => 'Subject associated to project successfully.'], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * @param int     $repositoryID
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function filterSubjects(int $repositoryID, Request $request): \Illuminate\Http\JsonResponse
    {
        // Could also be created a FilterSubjectRequest alternatively...
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'age'  => 'nullable|integer',
            // Add more validation rules as per your requirements
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $validatedData = $validator->validated();
            $filterSubjectsUseCase = new FilterSubjectsUseCase($this->repository);
            $filterSubjects = $filterSubjectsUseCase($repositoryID, $validatedData);

            return response()->json(['data' => $filterSubjects, 'message' => 'Subjects filtered successfully.'], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
}
