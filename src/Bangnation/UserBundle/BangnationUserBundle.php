<?php

namespace Bangnation\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BangnationUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
