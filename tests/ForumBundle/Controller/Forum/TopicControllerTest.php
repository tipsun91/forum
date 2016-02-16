<?php

namespace Tests\ForumBundle\Controller;

use Tests\ForumBundle\ForumWebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TopicControllerTest extends ForumWebTestCase
{
    public function testAdd()
    {
        $title = sprintf('Тест топика #%d', rand());
        $message = sprintf('Тест сообщения #%d', rand());

        $uri = self::$container->get('router')->generate('forum_show', ['id' => 1]);

        $crawler = self::$client->request('GET', $uri);

        $form = $crawler->selectButton('topic_post_submit')->form(['topic[topic-title]' => $title, 'topic[post][text]' => $message]);

        self::$client->submit($form);

        $this->assertTrue(self::$client->getResponse()->isRedirection());

        $crawler = self::$client->followRedirect();

        $this->assertContains($title, $crawler->filter('title')->text());
        $this->assertContains($message, $crawler->filter('li')->eq(1)->text());
    }

    public function testShow()
    {
        $text = 'Test post 1';

        $uri = self::$container->get('router')->generate('topic_show', ['id' => 1, 'page' => PHP_INT_MAX]);

        $crawler = self::$client->request('GET', $uri);

        $this->assertEquals(Response::HTTP_OK, self::$client->getResponse()->getStatusCode());

        $this->assertContains($text, $crawler->filter('li')->last()->text());
    }
}
