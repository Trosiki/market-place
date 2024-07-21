<?php
namespace TroskiShop\Infrastructure\Framework\Symfony;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import($this->getProjectDir() . '/config/{packages}/*.yaml');
        $container->import($this->getProjectDir() . '/config/{packages}/' . $this->environment . '/*.yaml');
        $container->import($this->getProjectDir() . '/config/{services}.yaml');
        $container->import($this->getProjectDir() . '/config/{services}_' . $this->environment . '.yaml');
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        // Import routes from YAML files if they exist
        $routes->import($this->getProjectDir() . '/config/{routes}/' . $this->environment . '/*.yaml', 'yaml');
        $routes->import($this->getProjectDir() . '/config/{routes}/*.yaml', 'yaml');

        // Import routes using attributes
        $routes->import($this->getProjectDir() . '/src/TroskiShop/Infrastructure/Framework/Symfony/Controller', 'attribute');

        // Import default routes if you have them
        $routes->import($this->getProjectDir() . '/config/{routes}.yaml', 'yaml');
    }
}
