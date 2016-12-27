<?php

namespace Tests\ForumBundle\Controller\Main;

use Symfony\Component\HttpFoundation\Response;


trait ControllerTest
{
    public function traitIndex($forum)
    {
        $uri = self::$container->get('router')->generate('index');

        self::$crawler = self::$client->request('GET', $uri);

        $this->assertEquals(Response::HTTP_OK, self::$client->getResponse()->getStatusCode());

        $isFound = false;
        try {
            if ('Пусто' == self::$crawler->filter('ul.forum_list > li.empty')->text()) {
                $isFound = true;
            }
        } catch (\InvalidArgumentException $e) {
            $domElement = self::$crawler->filter('span.forum_title')->getIterator();
            while ($domElement->valid()) {
                if ($forum == $domElement->current()->textContent) {
                    $isFound = true;
                    break;
                } else {
                    $isFound = false;
                }
                $domElement->next();
            }
        }

        return $isFound;
    }
}
