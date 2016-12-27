<?php

namespace Tests\ForumBundle\Controller\Main;

use Tests\ForumBundle\ForumWebTestCase;


class UserControllerTest extends ForumWebTestCase
{
    use ControllerTest;

    /**
     * @param string $forum
     * @dataProvider forumProvider
     */
    public function testShow($forum)
    {
        $this->assertTrue(
            $this->traitIndex($forum)
        );
    }
}
