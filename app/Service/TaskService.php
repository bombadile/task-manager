<?php

declare(strict_types=1);

namespace App\Service;

use App\Input\TaskFilterInput;
use App\Input\TaskSortInput;
use App\Model\Task;
use App\Input\TaskInput;
use App\Model\User;
use App\Repository\RepositoryInterface;
use App\Validator\ValidatorInterface;

class TaskService extends AbstractService
{
    private RepositoryInterface $userRepository;
    private RepositoryInterface $taskRepository;

    /**
     * @param \App\Validator\ValidatorInterface $validator
     * @param \App\Repository\RepositoryInterface $taskRepository
     * @param \App\Repository\RepositoryInterface $userRepository
     */
    public function __construct(
        ValidatorInterface $validator,
        RepositoryInterface $taskRepository,
        RepositoryInterface $userRepository
    ) {
        parent::__construct($validator);
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param \App\Input\TaskInput $taskInput
     * @return \App\Model\Task
     */
    public function create(TaskInput $taskInput): Task
    {
        $task = new Task($taskInput->getTitle(), $taskInput->getDescription(), $taskInput->getDueDate());
        $this->taskRepository->insert($task);
        return $task;
    }

    /**
     * @param \App\Input\TaskInput $taskInput
     * @return Task
     */
    public function edit(TaskInput $taskInput): Task
    {
        /** @var Task $task */
        $task = $this->getModel($this->taskRepository, $taskInput->getId());
        $task->edit($taskInput->getTitle(), $taskInput->getDescription(), $taskInput->getDueDate());
        $this->taskRepository->edit();
        return $task;
    }

    /**
     * @param \App\Input\TaskInput $taskInput
     * @return Task
     */
    public function changeStatus(TaskInput $taskInput): Task
    {
        /** @var Task $task */
        $task = $this->getModel($this->taskRepository, $taskInput->getId());
        $task->changeStatus($taskInput->getStatus());
        $this->taskRepository->edit();
        return $task;
    }

    /**
     * @param \App\Input\TaskInput $taskInput
     * @return bool
     */
    public function delete(TaskInput $taskInput): bool
    {
        /** @var Task $task */
        $task = $this->getModel($this->taskRepository, $taskInput->getId());
        $this->taskRepository->delete($task);
        return true;
    }

    /**
     * @param \App\Input\TaskInput $taskInput
     * @return Task
     */
    public function attachUser(TaskInput $taskInput): Task
    {
        /** @var Task $task */
        $task = $this->getModel($this->taskRepository, $taskInput->getId());

        /** @var User $user */
        $user = $this->getModel($this->userRepository, $taskInput->getUserId());

        $task->attachUser($user);
        $this->taskRepository->edit();
        return $task;
    }

    /**
     * @param \App\Input\TaskInput $taskInput
     * @return Task
     */
    public function detachUser(TaskInput $taskInput): Task
    {
        /** @var Task $task */
        $task = $this->getModel($this->taskRepository, $taskInput->getId());

        $task->detachUser();
        $this->taskRepository->edit();
        return $task;
    }

    /**
     * @param \App\Input\TaskFilterInput $filterInput
     * @param \App\Input\TaskSortInput $sortInput
     * @return Task[]|null
     */
    public function getTasks(TaskFilterInput $filterInput, TaskSortInput $sortInput): ?array
    {
        return $this->taskRepository->findBy($filterInput, $sortInput);
    }
}
