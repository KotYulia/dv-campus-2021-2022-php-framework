<?php

declare(strict_types=1);

namespace YuliiaKotenko\Framework\Http;

interface RouterInterface
{
    /**
     * @param string $requestUrl
     * @return string
     */
    public function match(string $requestUrl): string;
}
