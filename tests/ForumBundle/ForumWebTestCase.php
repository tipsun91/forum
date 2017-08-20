<?php

namespace Tests\ForumBundle;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DomCrawler\Crawler;

abstract class ForumWebTestCase extends WebTestCase
{
    /**
     * @var Client
     */
    protected static $client;

    /**
     * @var Container
     */
    protected static $container;

    /**
     * @var Crawler
     */
    protected static $crawler;

    /**
     * @var array
     */
    protected static $data;


    protected function setUp()
    {
        if (!self::$container) {
            self::$client = static::createClient();
            self::$container = self::$client->getContainer();
        }
    }

    /**
     * @return Crawler
     * @throws \Exception
     */
    protected static function login($username, $password)
    {
        $uri = self::$container->get('router')->generate('login_route');

        $crawler = self::$client->request('GET', $uri);

        $form = $crawler->selectButton('login_btn')->form(['_username' => $username, '_password' => $password]);

        self::$client->submit($form);

        self::assertTrue(self::$client->getResponse()->isRedirection());

        return self::$client->followRedirect();
    }


    /**
     * Change tracking
     */
    public function genderProvider()
    {
        return [
//            ['key', 'value'],
            [2, 'Женский'],
            [1, 'Мужской'],
            [0, 'Не указан'],
        ];
    }

    /**
     * Change tracking
     */
    public function passwordProvider()
    {
        return [
//            ['message', 'oldPassword', 'newPassword'],
            ['Пароль успешно изменен', 12345678, 87654321],
            ['Пароль успешно изменен', 87654321, 12345678],
        ];
    }


    /**
     * Fixture
     */
    public function userProvider()
    {
        return [
//            ['username', 'password'],
            [sprintf('form_registered_user_%d', mt_rand(1000, 9999)), 12345678],
        ];
    }

    /**
     * Data availability
     */
    public function forumProvider()
    {
        return [
//            ['forumTitle'],
            ['PHP'],
            ['MySQL'],
        ];
    }

    /**
     * Fixture
     */
    public function topicProvider()
    {
        if (! isset(self::$data['topics']) || empty(self::$data['topics'])) {
            self::$data['topics'] = [];

            // В пределах одной страницы. TODO: реализовать возможность перехода по страницам для поиска(?)
            for ($i = 0, $j = rand(15, 25); $i < $j; $i++) {
                self::$data['topics'][$i] = [
                    'topic' => ['title' => sprintf('Topic%d #%d', $i+1, mt_rand(1000, 9999))],
                    'post'  => ['text'  => 'Post, written on create topic.'],
                ];
            }
        }

        return self::$data['topics'];
    }

    /**
     * Fixture
     */
    public function topicFixtureProvider()
    {
        return [
            ['topic' => ['title' => 'Test topic 1 in PHP forum']],
            ['topic' => ['title' => 'Test topic 2 in PHP forum']],
        ];
    }

    /**
     * Fixture
     */
    public function postProvider()
    {
        if (! isset(self::$data['posts']) || empty(self::$data['posts'])) {
            self::$data['posts'] = [];

            // В пределах одной страницы. TODO: реализовать возможность перехода по страницам для поиска(?)
            for ($i = 0, $j = rand(1, 9); $i < $j; $i++) {
                self::$data['posts'][$i] = [
                    'post' => ['text' => sprintf('Post%d #%d', $i+1, mt_rand(1000, 9999))],
                ];
            }
        }

        return self::$data['posts'];
    }

    /**
     * @param Crawler $crawler
     * @return boolean|Crawler
     * TODO: Поиск записей по всем доступным страницам.
     */
    protected function pagination(Crawler $crawler)
    {
        $nextPageCrawler = $crawler->selectLink('След.');
        if ($nextPageCrawler && $nextPageCrawler->getNode(0) && false === mb_stripos(
            $nextPageCrawler->getNode(0)->getAttribute('class'),
            'ui-disabled',
            null,
            'UTF-8'
        )) {
            return self::$client->click($nextPageCrawler->link());
        }

        return false;
    }
}
