<?php

namespace Tests\ForumBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Tests\ForumBundle\ForumWebTestCase;

class PostControllerTest extends ForumWebTestCase
{
    public function testAdd()
    {
        $text = sprintf('Тест поста #%d', rand());

        $uri = self::$container->get('router')->generate('topic_show', ['id' => 1]);

        $crawler = self::$client->request('GET', $uri);

        $form = $crawler->selectButton('post_submit')->form(['post[text]' => $text]);

        self::$client->submit($form);

        $this->assertTrue(self::$client->getResponse()->isRedirection());

        $crawler = self::$client->followRedirect();

        $this->assertContains($text, $crawler->filter('li')->eq(1)->text());
    }

    public function testEdit()
    {
        $uri = self::$container->get('router')->generate('topic_show', ['id' => 1, 'page' => 1]);

        $crawler = self::$client->request('GET', $uri);

        $this->assertEquals(Response::HTTP_OK, self::$client->getResponse()->getStatusCode());

        $postText = $crawler->filter('li')->eq(1)->text(); // First post in list on first page
        $action = $crawler->filter('a.post_edit_button')->eq(0)->attr('data-url'); // First post...

        $form = $crawler->selectButton('post_edit_edit')->form(['post_edit[text]' => $postText . '_changed_']);

        $form->getNode()->setAttribute('action', $action);

        self::$client->submit($form);

        $this->assertTrue(self::$client->getResponse()->isRedirection());

        $crawler = self::$client->followRedirect();

        $this->assertContains('_changed_', $crawler->filter('li')->eq(1)->text()); // First post...
    }

    public function testDelete()
    {
        $uri = self::$container->get('router')->generate('topic_show', ['id' => 1, 'page' => 1]);

        $crawler = self::$client->request('GET', $uri);

        $this->assertEquals(Response::HTTP_OK, self::$client->getResponse()->getStatusCode());

        $postText = $crawler->filter('li')->eq(3)->text(); // Second post in list on first page
        $action = $crawler->filter('a.post_delete_button')->eq(1)->attr('data-url'); // Second post...

        $form = $crawler->selectButton('post_delete_delete')->form();

        $form->getNode()->setAttribute('action', $action);

        self::$client->submit($form);

        $this->assertTrue(self::$client->getResponse()->isRedirection());

        $crawler = self::$client->followRedirect();

        $this->assertNotContains($postText, $del = $crawler->filter('li')->eq(3)->text()); // Second post...
    }
}
