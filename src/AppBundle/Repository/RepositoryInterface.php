<?php

namespace AppBundle\Repository;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface RepositoryInterface extends ObjectRepository, Selectable
{
    /**
     * @param $entity
     * @return mixed
     */
    public function save($entity);

    /**
     * @param $entity
     * @return mixed
     */
    public function remove($entity);

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);
}
