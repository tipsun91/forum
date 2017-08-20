<?php

namespace Tests\ForumBundle\Controller;

use Tests\ForumBundle\ForumWebTestCase;


class AdminControllerTest extends ForumWebTestCase
{
    use ControllerTest;

    /**
     * @param string $message
     * @param string $oldPassword
     * @param string $newPassword
     * @dataProvider passwordProvider
     */
    public function testChangePassword($message, $oldPassword, $newPassword)
    {
        $this->assertEquals(
            $message,
            $this->traitChangePassword($message, $oldPassword, $newPassword)
        );
    }
}
