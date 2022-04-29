<?php

namespace Tests\Repositories;

use App\Contracts\{Entity, Repository};
use PHPUnit\Framework\TestCase;

abstract class AbstractRepositoryTest extends TestCase
{
    abstract public function getRepository(): Repository;
    abstract public function getEntity(): \Generator;
    abstract public function getUpdatedEntity(): Entity;

    /**
     * @test
     * @dataProvider getEntity
     */
    public function repository_ShouldSaveEntity($entity): void
    {
        $repository = $this->getRepository();
        $repository->save($entity);

        $expectedTotal = 1;
        $this->assertCount($expectedTotal, $repository->all());
    }

    /**
     * @test
     * @dataProvider getEntity
     */
    public function repository_ShouldGetAll($entity): void
    {
        $repository = $this->getRepository();

        $repository->save($entity);
        $repository->save($entity);
        $repository->save($entity);

        $expectedTotal = 3;
        $this->assertCount($expectedTotal, $repository->all());
    }

    /**
     * @test
     * @dataProvider getEntity
     */
    public function repository_ShouldFindEntityById($entity): void
    {
        $repository = $this->getRepository();

        $repository->save($entity);
        $data = $repository->find(1);

        // TODO: Melhorar teste
        $this->assertEquals($entity->getWhen()->format('Y-m-d H:i:s'), $data['when']);
    }

    /**
     * @test
     * @dataProvider getEntity
     */
    public function repository_ShouldUpdateEntity($entity)
    {
        $repository = $this->getRepository();
        $repository->save($entity);
        $updatedEntity = $this->getUpdatedEntity();

        $repository->update(1, $updatedEntity);
        $currentEntity = $repository->find(1);

        $this->assertNotEquals(serialize($entity), serialize($currentEntity));
    }

    /**
     * @test
     * @dataProvider getEntity
     */
    public function repository_ShouldDeleteEntity($entity): void
    {
        $repository = $this->getRepository();
        $repository->save($entity);
        $repository->save($entity);
        $repository->delete(1);

        $expectedEntitiesTotal = 1;
        $this->assertCount($expectedEntitiesTotal, $repository->all());
    }
}