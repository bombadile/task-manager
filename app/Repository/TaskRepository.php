<?php

declare(strict_types=1);

namespace App\Repository;

use App\Input\TaskFilterInput;
use App\Input\TaskSortInput;
use App\Model\Task;

class TaskRepository extends AbstractRepository
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return $this->getMetadataName(Task::class);
    }

    /**
     * @param \App\Input\TaskFilterInput $filterInput
     * @param \App\Input\TaskSortInput $sortInput
     * @return Task[]|null
     */
    public function findBy(TaskFilterInput $filterInput, TaskSortInput $sortInput): array
    {
        $builder = $this->repository->createQueryBuilder('t');
        $builder->select('t')
            ->setFirstResult($filterInput->getOffset())
            ->setMaxResults($filterInput->getLimit());

        if ($userId = $filterInput->getUserId()) {
            $builder->andWhere('t.user = :user_id')->setParameter('user_id', $userId);
        }

        if ($status = $filterInput->getStatus()) {
            $builder->andWhere('t.status = :status')->setParameter('status', $status);
        }

        if ($dueDataStart = $filterInput->getDueDateStart()) {
            $builder->andWhere('t.dueDate >= :due_date_start')->setParameter('due_date_start', $dueDataStart);
        }

        if ($dueDataEnd = $filterInput->getDueDateEnd()) {
            $builder->andWhere('t.dueDate <= :due_date_end')->setParameter('due_date_end', $dueDataEnd);
        }

        $builder->orderBy('t.' . $sortInput->getField(), $sortInput->getDirection());

        return $builder->getQuery()->getResult();
    }
}
