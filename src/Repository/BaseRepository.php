<?php
/**
 *
 * @Author: bthrower
 * @CreateAt: 1/7/2019 2:50 PM
 * Project: EncounterTheCross
 * File Name: BaseRepository.php
 */

namespace App\Repository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class BaseRepository extends ServiceEntityRepository
{
    public function findOneByID($id)
    {
        return $this->findOneBy([
            'id' => $id
        ]);
    }

    public function findAllOrderedByASC($properties)
    {
        $filter = [];
        foreach ($properties as $property) {
            $filter[$property] = 'ASC';
        }
        return $this->findBy([],$filter);
    }

    public function findAllOrderedByDESC($property)
    {
        return $this->findBy([],[$property=>'DESC']);
    }
}
