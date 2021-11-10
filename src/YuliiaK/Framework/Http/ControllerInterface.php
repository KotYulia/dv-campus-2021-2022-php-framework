<?php
declare(strict_types=1);

namespace YuliiaK\Framework\Http;

use YuliiaK\Framework\Http\Response\Raw;

interface ControllerInterface
{
    public function execute(): Raw;
}
