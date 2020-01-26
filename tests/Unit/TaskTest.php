<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Enum\TaskSortDirection;
use App\Enum\TaskSortField;
use App\Enum\TaskStatus;
use App\Input\TaskFilterInput;
use App\Input\TaskSortInput;
use App\Model\Task;
use App\Input\TaskInput;
use App\Model\User;
use App\Service\ServiceException;
use App\Validator\TaskValidator;
use App\Repository\TaskRepository;
use App\Service\TaskService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use App\Repository\UserRepository;

class TaskTest extends TestCase
{
    private TaskService $service;

    private MockObject $taskRepository;
    private MockObject $userRepository;

    public function setUp(): void
    {
        parent::setUp();

        /** @var TaskRepository|MockObject $taskRepository */
        $taskRepository = $this->createMock(TaskRepository::class);
        $this->taskRepository = $taskRepository;

        /** @var UserRepository|MockObject $userRepository */
        $userRepository = $this->createMock(TaskRepository::class);
        $this->userRepository = $userRepository;

        $validator = new TaskValidator($this->taskRepository);

        $this->service = new TaskService($validator, $this->taskRepository, $this->userRepository);
    }

    public function testCreateTask(): void
    {
        $taskInput = (new TaskInput())
            ->setTitle('test')
            ->setDescription('description')
            ->setDueDate(\DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2020-03-01 14:00:00'));

        $this->assertTrue($this->service->isValid($taskInput));
        $this->assertInstanceOf(Task::class, $this->service->create($taskInput));
    }

    public function testCreateTaskWithEmptyTitle(): void
    {
        $taskInput = (new TaskInput())
            ->setTitle('')
            ->setDescription('description')
            ->setDueDate(\DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2020-03-01 14:00:00'));

        $this->assertFalse($this->service->isValid($taskInput));
        $this->assertNotEmpty($this->service->getErrorsValidation());
    }

    public function testEditTask(): void
    {
        $taskInput = (new TaskInput())->setId(1)->setTitle('new_test');
        $taskMock = new Task('test');

        $this->taskRepository->expects($this->any())->method('findOneBy')->willReturn($taskMock);
        $this->assertTrue($this->service->isValid($taskInput));
        $task = $this->service->edit($taskInput);
        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals($taskInput->getTitle(), $task->getTitle());
    }

    public function testEditTaskWhichNotFound(): void
    {
        $taskInput = (new TaskInput())->setId(1)->setTitle('new_test');

        $this->assertTrue($this->service->isValid($taskInput));
        $this->expectException(ServiceException::class);
        $this->service->edit($taskInput);
    }

    public function testDeleteTask(): void
    {
        $taskInput = (new TaskInput())->setId(1);
        $taskMock = new Task('test');

        $this->taskRepository->expects($this->any())->method('findOneBy')->willReturn($taskMock);
        $this->assertTrue($this->service->isValid($taskInput));
        $this->assertTrue($this->service->delete($taskInput));
    }

    public function testChangeStatus(): void
    {
        $taskInput = (new TaskInput())->setId(1)->setStatus(TaskStatus::DOING);
        $taskMock = new Task('test');

        $this->taskRepository->expects($this->any())->method('findOneBy')->willReturn($taskMock);
        $this->assertTrue($this->service->isValid($taskInput));
        $task = $this->service->changeStatus($taskInput);
        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals($taskInput->getStatus(), $task->getStatus());
    }

    public function testAttachAndDetachUser(): void
    {
        $taskInput = (new TaskInput())->setId(1)->setUserId(1);
        $taskMock = new Task('test');
        $userMock = new User('test', 'test@test.ru');

        $this->taskRepository->expects($this->any())->method('findOneBy')->willReturn($taskMock);
        $this->userRepository->expects($this->any())->method('findOneBy')->willReturn($userMock);

        $task = $this->service->attachUser($taskInput);
        $this->assertTrue($task->getUser() === $userMock);

        $taskInput = (new TaskInput())->setId(1);
        $task = $this->service->detachUser($taskInput);
        $this->assertFalse($task->hasUser());
    }

    public function testGetTasks()
    {
        $tasksMock = [new Task('test')];
        $taskFilterInput = (new TaskFilterInput())->setUserId(1)->setStatus(TaskStatus::TO_DO);
        $taskSortInput = (new TaskSortInput())->setField(TaskSortField::ID)->setDirection(TaskSortDirection::ASC);

        $this->taskRepository->expects($this->any())->method('findBy')->willReturn($tasksMock);

        $this->assertTrue($this->service->isValid($taskFilterInput));
        $tasks = $this->service->getTasks($taskFilterInput, $taskSortInput);
        $this->assertInstanceOf(Task::class, $tasks[0]);
    }
}
