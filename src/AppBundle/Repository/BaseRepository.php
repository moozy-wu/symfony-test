<?php

namespace AppBundle\Repository;


use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;

abstract class BaseRepository extends EntityRepository implements RepositoryInterface
{
    /**
     * @param $entity
     * @return mixed
     */
    public function save($entity)
    {
        $this->_em->persist($entity);
        $this->_em->flush();

        return $entity;
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function remove($entity)
    {
        $this->_em->remove($entity);
        $this->_em->flush();

        return $entity;
    }

    /**
     * @param int $id
     * @return null|object
     * @throws EntityNotFoundException
     */
    public function getById(int $id)
    {
        $result = $this->findOneBy(['id' => $id]);

        if (null === $result) {
            throw new EntityNotFoundException();
        }

        return $result;
    }
}
