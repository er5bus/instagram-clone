<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\OneToMany(targetEntity="App\Entity\ImageFile", mappedBy="post")
     */
    private $postContent;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     */
    private $author;


    public function __construct()
    {
        $this->postContent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|ImageFile[]
     */
    public function getPostContent(): Collection
    {
        return $this->postContent;
    }

    public function addPostContent(ImageFile $postContent): self
    {
        if (!$this->postContent->contains($postContent)) {
            $this->postContent[] = $postContent;
            $postContent->setPost($this);
        }

        return $this;
    }

    public function removePostContent(ImageFile $postContent): self
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

    public function getImageFiles(): ?array
    {
        return $this->imageFiles;
    }

    public function setImageFiles(array $imageFiles): self
    {
        $this->imageFiles = $imageFiles;

        return $this;
    }
}
