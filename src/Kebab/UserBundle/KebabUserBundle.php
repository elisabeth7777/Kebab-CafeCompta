<?php

namespace Kebab\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KebabUserBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
