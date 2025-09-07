<?php

namespace queasy\container;

use Exception;

use Psr\Container\ContainerInterface;

class ServiceContainer implements ContainerInterface
{
    protected $servicesConfig;

    protected $services = array();

    public function __construct($servicesConfig)
    {
        $this->servicesConfig = $servicesConfig;
    }

    public function __isset($serviceId)
    {
        return $this->has($serviceId);
    }

    public function __get($serviceId)
    {
        return $this->get($serviceId);
    }

    /**
     * Returns true if the container can return a service for the given identifier.
     * Returns false otherwise.
     *
     * `has($serviceId)` returning true does not mean that `get($serviceId)` will not throw an exception.
     * It does however mean that `get($serviceId)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $serviceId Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($serviceId)
    {
        return isset($this->servicesConfig[$serviceId]);
    }

    /**
     * Finds a service of the container by its identifier and returns it.
     *
     * @param string $serviceId Identifier of the service to look for.
     *
     * @throws NotFoundExceptionInterface  No service was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the service.
     *
     * @return mixed Entry.
     */
    public function get($serviceId)
    {
        if ('config' === $serviceId) {
            return $this->servicesConfig;
        }

        if (!isset($this->services[$serviceId])) {
            if (!isset($this->servicesConfig[$serviceId])) {
                throw new NotFoundException("Service \"$serviceId\" not found");
            }

            try {
                $this->services[$serviceId] = is_callable($this->servicesConfig[$serviceId])
                    ? $this->servicesConfig[$serviceId]($this)
                    : $this->servicesConfig[$serviceId];
            } catch (Exception $e) {
                throw new ContainerException("Cannot initialize service \"$serviceId\"");
            }
        }

        return $this->services[$serviceId];
    }
}

