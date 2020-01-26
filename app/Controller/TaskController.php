<?php

declare(strict_types=1);

namespace App\Controller;

use App\Input\TaskFilterInput;
use App\Input\TaskInput;
use App\Input\TaskSortInput;
use App\Model\Task;
use App\Service\TaskService;
use TheCodingMachine\GraphQLite\Annotations\Query;
use TheCodingMachine\GraphQLite\Annotations\Mutation;
use TheCodingMachine\GraphQLite\Annotations\UseInputType;

class TaskController extends AbstractController
{

    /**
     * @param \App\Service\TaskService $service
     */
    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    /**
     * @Mutation
     * @UseInputType(for="$taskInput", inputType="CreateTaskInput!")
     * @param \App\Input\TaskInput $taskInput
     * @return \App\Model\Task
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLAggregateException
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLException
     */
    public function createTask(TaskInput $taskInput): Task
    {
        $this->validate($taskInput);
        return $this->process(
            function () use ($taskInput) {
                return $this->service->create($taskInput);
            }
        );
    }

    /**
     * @Mutation
     * @UseInputType(for="$taskInput", inputType="EditTaskInput!")
     * @param \App\Input\TaskInput $taskInput
     * @return \App\Model\Task
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLAggregateException
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLException
     */
    public function editTask(TaskInput $taskInput): Task
    {
        $this->validate($taskInput);
        return $this->process(
            function () use ($taskInput) {
                return $this->service->edit($taskInput);
            }
        );
    }

    /**
     * @Mutation
     * @UseInputType(for="$taskInput", inputType="ChangeStatusTaskInput!")
     * @param \App\Input\TaskInput $taskInput
     * @return \App\Model\Task
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLAggregateException
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLException
     */
    public function changeStatusTask(TaskInput $taskInput): Task
    {
        $this->validate($taskInput);
        return $this->process(
            function () use ($taskInput) {
                return $this->service->changeStatus($taskInput);
            }
        );
    }

    /**
     * @Mutation
     * @UseInputType(for="$taskInput", inputType="AttachUserTaskInput!")
     * @param \App\Input\TaskInput $taskInput
     * @return \App\Model\Task
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLException
     */
    public function attachUserTask(TaskInput $taskInput): Task
    {
        return $this->process(
            function () use ($taskInput) {
                return $this->service->attachUser($taskInput);
            }
        );
    }

    /**
     * @Mutation
     * @UseInputType(for="$taskInput", inputType="DetachUserTaskInput!")
     * @param \App\Input\TaskInput $taskInput
     * @return \App\Model\Task
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLException
     */
    public function detachUserTask(TaskInput $taskInput): Task
    {
        return $this->process(
            function () use ($taskInput) {
                return $this->service->detachUser($taskInput);
            }
        );
    }

    /**
     * @Mutation
     * @UseInputType(for="$taskInput", inputType="DeleteTaskInput!")
     * @param \App\Input\TaskInput $taskInput
     * @return bool
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLException
     */
    public function deleteTask(TaskInput $taskInput): bool
    {
        return $this->process(
            function () use ($taskInput) {
                return $this->service->delete($taskInput);
            }
        );
    }

    /**
     * @Query
     * @UseInputType(for="$taskFilterInput", inputType="GetTasksFilterInput!")
     * @UseInputType(for="$taskSortInput", inputType="GetTasksSortInput!")
     * @param \App\Input\TaskFilterInput $taskFilterInput
     * @param \App\Input\TaskSortInput $taskSortInput
     * @return Task[]|null
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLAggregateException
     * @throws \TheCodingMachine\GraphQLite\Exceptions\GraphQLException
     */
    public function getTasks(TaskFilterInput $taskFilterInput, TaskSortInput $taskSortInput): ?array
    {
        $this->validate($taskFilterInput);
        return $this->process(
            function () use ($taskFilterInput, $taskSortInput) {
                return $this->service->getTasks($taskFilterInput, $taskSortInput);
            }
        );
    }
}
