<?php

namespace ForumBundle\Entity;

/**
 * Topic
 */
class Topic
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var boolean
     */
    private $closed = '0';

    /**
     * @var boolean
     */
    private $fixed = '0';

    /**
     * @var integer
     */
    private $countPosts = '0';

    /**
     * @var \ForumBundle\Entity\Forum
     */
    private $forum;

    /**
     * @var \DateTime
     */
    private $createdAt;
    /**
     * @var \ForumBundle\Entity\User
     */
    private $user;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Topic
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set closed
     *
     * @param boolean $closed
     *
     * @return Topic
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * Get closed
     *
     * @return boolean
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Set fixed
     *
     * @param boolean $fixed
     *
     * @return Topic
     */
    public function setFixed($fixed)
    {
        $this->fixed = $fixed;

        return $this;
    }

    /**
     * Get fixed
     *
     * @return boolean
     */
    public function getFixed()
    {
        return $this->fixed;
    }

    /**
     * Set countPosts
     *
     * @param integer $countPosts
     *
     * @return Topic
     */
    public function setCountPosts($countPosts)
    {
        $this->countPosts = $countPosts;

        return $this;
    }

    /**
     * Get countPosts
     *
     * @return integer
     */
    public function getCountPosts()
    {
        return $this->countPosts;
    }

    /**
     * Get forum
     *
     * @return \ForumBundle\Entity\Forum
     */
    public function getForum()
    {
        return $this->forum;
    }

    /**
     * Set createdAt
     *
     * @return Topic
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();

        return $this;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime
     *
     * @return Topic
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get user
     *
     * @return \ForumBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set forum
     *
     * @param \ForumBundle\Entity\Forum $forum
     *
     * @return Topic
     */
    public function setForum(\ForumBundle\Entity\Forum $forum)
    {
        $this->forum = $forum;

        return $this;
    }

    /**
     * Set user
     *
     * @param \ForumBundle\Entity\User $user
     *
     * @return Topic
     */
    public function setUser(\ForumBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }
}
