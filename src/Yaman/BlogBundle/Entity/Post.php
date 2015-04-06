<?php

namespace Yaman\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="post")
 */
class Post
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     */
    protected $content;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $status;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="post")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $tag;



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
     * @return Post
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
     * Set content
     *
     * @param string $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Post
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set tag
     *
     * @param \Yaman\BlogBundle\Entity\Tag $tag
     * @return Post
     */
    public function setTag(\Yaman\BlogBundle\Entity\Tag $tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return \Yaman\BlogBundle\Entity\Tag 
     */
    public function getTag()
    {
        return $this->tag;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tag = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tag
     *
     * @param \Yaman\BlogBundle\Entity\Tag $tag
     * @return Post
     */
    public function addTag(\Yaman\BlogBundle\Entity\Tag $tag)
    {
        $this->tag[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Yaman\BlogBundle\Entity\Tag $tag
     */
    public function removeTag(\Yaman\BlogBundle\Entity\Tag $tag)
    {
        $this->tag->removeElement($tag);
    }
}
