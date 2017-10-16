<?php

namespace AppBundle\Repository;

use Doctrine\ORM\NoResultException;

/**
 * UserRepository
 *
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function getSingleUserById($id)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT u, t FROM AppBundle:User u 
                     JOIN u.tasks t
                     WHERE u.id = :id'
            )->setParameter('id', $id);

        try {
            return $query->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        }
    }

    public function getUsers()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT u, t FROM AppBundle:User u 
                     JOIN u.tasks t'
            );

        try {
            return $query->getArrayResult();
        } catch (NoResultException $e) {
            return null;
        }

    }

}
