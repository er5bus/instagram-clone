<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UploadedFile", mappedBy="post")
     */
    private $postContent;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Thread", mappedBy="post")
     */
    private $comments;


    public function __construct()
    {
        $this->postContent = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|UploadedFile[]
     */
    public function getPostContent(): Collection
    {
        return $this->postContent;
    }

    public function addPostContent(UploadedFile $postContent): self
    {
        if (!$this->postContent->contains($postContent)) {
            $this->postContent[] = $postContent;
            $postContent->setPost($this);
        }

        return $this;
    }

    public function removePostContent(UploadedFile $postContent): self
    {
        if ($this->postContent->contains($postContent)) {
            $this->postContent->removeElement($postContent);
            // set the owning side to null (unless already changed)
            if ($postContent->getPost() === $this) {
                $postContent->setPost(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Thread[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Thread $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Thread $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

        return $this;
    }
}
