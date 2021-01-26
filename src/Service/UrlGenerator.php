<?php

namespace App\Service;

class UrlGenerator
{
   private \AltoRouter $router;

   /**
    * UrlGenerator constructor.
    * @param \AltoRouter $router
    */
   public function __construct(\AltoRouter $router)
   {
      $this->router = $router;
   }

   /**
    * @param string $url_name
    * @return string
    * @throws \Exception
    */
   public function generate(string $url_name): string {
      return $this->router->generate($url_name);
   }
}