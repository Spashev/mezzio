<?php 

namespace App\DB;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;

class DbFactory 
{
    public function __invoke(ContainerInterface $containerInterface) : AdapterInterface
    {
        $config = $containerInterface->get('config');
        return new Adapter($config['db']);
    }
}