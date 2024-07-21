<?php
namespace TroskiShop\Infrastructure\Framework\Symfony;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../../../../../config/{packages}/*.yaml');
        $container->import('../../../../../config/{packages}/'.$this->environment.'/*.yaml');
        $container->import('../../../../../config/{services}.yaml');
        $container->import('../../../../../config/{services}_'.$this->environment.'.yaml');
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('../config/{routes}/' . $this->environment . '/*.yaml');
        $routes->import('../config/{routes}/*.yaml');
        $routes->import('../src/TroskiShop/UI/Controller/', 'annotation');
        $routes->import('../config/{routes}.yaml');
        $routes->import('../../../../../config/{routes}/*.yaml');
        $routes->import('../../../../../config/{routes}/'.$this->environment.'/*.yaml');
        $routes->import('../../../../../config/{routes}.yaml');
    }
}
