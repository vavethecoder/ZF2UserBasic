<?php

namespace Tutorial\Repository;
 
use Doctrine\ORM\EntityRepository;
 
class RoleRepository extends EntityRepository
{
    public function getRole()
    {
        $querybuilder = $this->createQueryBuilder('r');
        return $querybuilder->select('r')
                    ->groupBy('r.role')
                    ->orderBy('r.id', 'ASC')
                    ->getQuery()->getResult();
    }
}
