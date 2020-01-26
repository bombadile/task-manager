<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Model\User;
use App\Input\UserInput;
use App\Service\ServiceException;
use App\Validator\UserValidator;
use App\Repository\UserRepository;
use App\Service\UserService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private UserService $service;

    private MockObject $userRepository;

    public function setUp(): void
    {
        parent::setUp();

        /** @var UserRepository|MockObject $repository */
        $repository = $this->createMock(UserRepository::class);
        $this->userRepository = $repository;

        $validator = new UserValidator($this->userRepository);

        $this->service = new UserService($validator, $this->userRepository);
    }

    public function testCreateUser(): void
    {
        $userInput = (new UserInput())->setName('test')->setEmail('test@test.ru');

        $this->assertTrue($this->service->isValid($userInput));
        $this->assertInstanceOf(User::class, $this->service->create($userInput));
    }

    public function testCreateUserWithWrongEmail(): void
    {
        $userInput = (new UserInput())->setName('test')->setEmail('wrong@email');

        $this->assertFalse($this->service->isValid($userInput));
        $this->assertNotEmpty($this->service->getErrorsValidation());
    }

    public function testCreateUserWithNotUniqueEmail(): void
    {
        $userInput = (new UserInput())->setName('test')->setEmail('test@test.ru');
        $userMock = new User('test', 'test@test.ru');

        $this->userRepository->expects($this->once())->method('findOneBy')->willReturn($userMock);
        $this->assertFalse($this->service->isValid($userInput));
        $this->assertNotEmpty($this->service->getErrorsValidation());
    }

    public function testEditUser(): void
    {
        $userInput = (new UserInput())->setId(1)->setName('new_test');
        $userMock = new User('test', 'test@test.ru');

        $this->userRepository->expects($this->any())->method('findOneBy')->willReturn($userMock);
        $this->assertTrue($this->service->isValid($userInput));
        $user = $this->service->edit($userInput);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userInput->getName(), $user->getName());
    }

    public function testEditUserWhichNotFound(): void
    {
        $userInput = (new UserInput())->setId(1)->setName('test');

        $this->assertTrue($this->service->isValid($userInput));
        $this->expectException(ServiceException::class);
        $this->service->edit($userInput);
    }

    public function testDeleteUser(): void
    {
        $userInput = (new UserInput())->setId(1);
        $userMock = new User('test', 'test@test.ru');

        $this->userRepository->expects($this->any())->method('findOneBy')->willReturn($userMock);
        $this->assertTrue($this->service->isValid($userInput));
        $this->assertTrue($this->service->delete($userInput));
    }
}
