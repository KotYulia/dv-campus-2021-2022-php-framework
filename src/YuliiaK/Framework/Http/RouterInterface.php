<?php

declare(strict_types=1);

namespace YuliiaK\Framework\Http;

interface RouterInterface
{
    /**
     * @param string $requestUrl
     * @return string
     */
    public function match(string $requestUrl): string;
}
