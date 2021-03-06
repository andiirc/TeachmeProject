<?php

use Faker\Factory as Faker;
use Faker\Generator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

abstract class BaseSeeder extends Seeder
{
    protected $total = 50;
    protected static $pool = array();

    public function run()
    {
        $this->createMultiple($this->total);
    }

    protected function createMultiple($total, array $customValues = array())
    {
        for ($i = 0;$i <= $total;$i++) {
            $this->create($customValues);
        }
    }

    protected function create(array $customValues = array())
    {
        $values = $this->getDummyData(Faker::create(), $customValues);
        $values = array_merge($values, $customValues);

        return $this->addToPool($this->getModel()->create($values));
    }

    abstract public function getModel();

    abstract public function getDummyData(Generator $facker, array $customValues = array());

    protected function getRandom($model)
    {
        if (!$this->collectionExist($model)) {
            throw new Exception("The $model collection does no exist");
        }

        return static::$pool[$model]->random();
    }

    protected function addToPool($entity)
    {
        $reflection = new ReflectionClass($entity);
        $class = $reflection->getShortName();

        if (!$this->collectionExist($class)) {
            static::$pool[$class] = new Collection();
        }

        static::$pool[$class]->add($entity);

        return $entity;
    }

    private function collectionExist($class)
    {
        return isset(static::$pool[$class]);
    }

    /*
    protected function createFrom($seeder, array $customValues = array()){

        $seeder = new $seeder;
        return $seeder->create($customValues);
    }*/
}
