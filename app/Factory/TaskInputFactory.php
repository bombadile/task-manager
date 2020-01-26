<?php

declare(strict_types=1);

namespace App\Factory;

use App\Enum\TaskSortDirection;
use App\Enum\TaskSortField;
use App\Enum\TaskStatus;
use App\Input\TaskFilterInput;
use App\Input\TaskInput;
use App\Input\TaskSortInput;
use TheCodingMachine\GraphQLite\Annotations\Factory;

class TaskInputFactory
{
    /**
     * @Factory(name="CreateTaskInput", default=false)
     * @param string $title
     * @param string|null $description
     * @param \DateTimeImmutable|null $dueDate
     * @return \App\Input\TaskInput
     */
    public function createTask(string $title, ?string $description, ?\DateTimeImmutable $dueDate): TaskInput
    {
        return (new TaskInput())->setTitle($title)->setDescription($description)->setDueDate($dueDate);
    }

    /**
     * @Factory(name="EditTaskInput", default=false)
     * @param int $id
     * @param string $title
     * @param string|null $description
     * @param \DateTimeImmutable|null $dueDate
     * @return \App\Input\TaskInput
     */
    public function editTask(int $id, string $title, ?string $description, ?\DateTimeImmutable $dueDate): TaskInput
    {
        return (new TaskInput())->setId($id)->setTitle($title)->setDescription($description)->setDueDate($dueDate);
    }

    /**
     * @Factory(name="DeleteTaskInput", default=false)
     * @param int $id
     * @return \App\Input\TaskInput
     */
    public function deleteTask(int $id): TaskInput
    {
        return (new TaskInput())->setId($id);
    }

    /**
     * @Factory(name="ChangeStatusTaskInput", default=false)
     * @param int $id
     * @param TaskStatus $status
     * @return \App\Input\TaskInput
     */
    public function changeStatusTask(int $id, TaskStatus $status): TaskInput
    {
        return (new TaskInput())->setId($id)->setStatus($status->getValue());
    }

    /**
     * @Factory(name="AttachUserTaskInput", default=false)
     * @param int $id
     * @param int $userId
     * @return \App\Input\TaskInput
     */
    public function attachUserTask(int $id, int $userId): TaskInput
    {
        return (new TaskInput())->setId($id)->setUserId($userId);
    }

    /**
     * @Factory(name="DetachUserTaskInput", default=false)
     * @param int $id
     * @return \App\Input\TaskInput
     */
    public function detachUserTask(int $id): TaskInput
    {
        return (new TaskInput())->setId($id);
    }

    /**
     * @Factory(name="GetTasksFilterInput", default=false)
     * @param int|null $userId
     * @param \DateTimeImmutable|null $dueDateStart
     * @param \DateTimeImmutable|null $dueDateEnd
     * @param \App\Enum\TaskStatus|null $status
     * @param int $limit
     * @param int $offset
     * @return \App\Input\TaskFilterInput
     */
    public function getTasksFilter(
        ?int $userId,
        ?\DateTimeImmutable $dueDateStart,
        ?\DateTimeImmutable $dueDateEnd,
        ?TaskStatus $status,
        int $limit,
        int $offset
    ): TaskFilterInput {
        $taskFilterInput = (new TaskFilterInput())
            ->setUserId($userId)
            ->setDueDateStart($dueDateStart)
            ->setDueDateEnd($dueDateEnd)
            ->setLimit($limit)
            ->setOffset($offset);

        if ($status) {
            $taskFilterInput->setStatus($status->getValue());
        }

        return $taskFilterInput;
    }

    /**
     * @Factory(name="GetTasksSortInput", default=false)
     * @param \App\Enum\TaskSortField $field
     * @param \App\Enum\TaskSortDirection $direction
     * @return \App\Input\TaskSortInput
     */
    public function getTasksSort(TaskSortField $field, TaskSortDirection $direction): TaskSortInput
    {
        return (new TaskSortInput())->setField($field->getValue())->setDirection($direction->getValue());
    }
}
