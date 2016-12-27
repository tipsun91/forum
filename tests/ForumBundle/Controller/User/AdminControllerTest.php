<?php

namespace Tests\ForumBundle\Controller;

use Tests\ForumBundle\ForumWebTestCase;
use Tests\ForumBundle\Controller\Forum\ControllerTest;


class AdminControllerTest extends ForumWebTestCase
{
    use ControllerTest;

    /**
     * @param array $topic
     * @dataProvider topicFixtureProvider
     */
    public function testShow($topic)
    {
        $this->assertTrue($this->show($topic));
    }
}
