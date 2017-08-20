<?php

namespace Tests\ForumBundle\Controller;

use Tests\ForumBundle\ForumWebTestCase;
use Tests\ForumBundle\Controller\Forum\ControllerTest;


class GuestControllerTest extends ForumWebTestCase
{
    use ControllerTest;

    /**
     * @param string $username
     * @param string $plainPassword
     * @dataProvider userProvider
     */
    public function testNew($username, $plainPassword)
    {
        $this->assertEquals(
            $username,
            $this->traitNew($username, $plainPassword)
        );
    }
}
