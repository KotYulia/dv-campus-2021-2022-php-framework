<?php

declare(strict_types=1);

namespace YuliiaK\Framework\Http;

use YuliiaK\Framework\Http\Response\NotFound;

class RequestDispatcher
{
    /**
     * @var RouterInterface[] $routers
     */
    private array $routers;

    private \YuliiaK\Framework\Http\Request $request;

    private \DI\FactoryInterface $factory;

    /**
     * RequestDispatcher constructor.
     * @param array $routers
     * @param Request $request
     * @param \DI\FactoryInterface $factory
     */
    public function __construct(
        array $routers,
        \YuliiaK\Framework\Http\Request $request,
        \DI\FactoryInterface $factory
    ) {
        foreach ($routers as $router) {
            if (!($router instanceof RouterInterface)) {
                throw new \InvalidArgumentException('Routers must implement ' . RouterInterface::class);
            }
        }

        $this->routers = $routers;
        $this->request = $request;
        $this->factory = $factory;
    }

    public function dispatch(): void
    {
        $requestUrl = $this->request->getRequestUrl();

        foreach ($this->routers as $router) {
            if ($controllerClass = $router->match($requestUrl)) {
                $controller = $this->factory->make($controllerClass);

                if (!($controller instanceof ControllerInterface)) {
                    throw new \InvalidArgumentException(
                        "Controller $controller must implement " . ControllerInterface::class
                    );
                }

                $response = $controller->execute();
            }
        }

        if (!isset($response)) {
            $response = $this->factory->make(NotFound::class);
        }

        $response->send();
    }
}