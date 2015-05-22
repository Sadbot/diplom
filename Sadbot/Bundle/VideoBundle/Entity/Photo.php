<?php

namespace Sadbot\Bundle\VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Iphp\FileStoreBundle\Mapping\Annotation as FileStore;

/**
 * Photo
 *
 * @ORM\Table(name="photo", indexes={@ORM\Index(name="photo_author_idx", columns={"author"}), @ORM\Index(name="photo_category_idx", columns={"photo_category"})})
 * @ORM\Entity(repositoryClass="Sadbot\Bundle\VideoBundle\Entity\PhotoRepository")
 * @FileStore\Uploadable
 */
class Photo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hash", type="string", length=255, nullable=false)
     */
    private $hash;

    /**
     * @ORM\Column(type="array")
     * @Assert\File(
     *      maxSize = "5M",
     *      maxSizeMessage = "Слишком большой файл",
     *      mimeTypes = {"image/jpeg", "image/gif", "image/png", "image/tiff"},
     *      mimeTypesMessage = "Только файловые типы изображения могут быть загружены."
     * )
     * @FileStore\UploadableField(mapping="photo")
     */
    private $file;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="\Sadbot\Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="author", referencedColumnName="id")
     * })
     */
    private $author;

    /**
     * @var \PhotoCategory
     *
     * @ORM\ManyToOne(targetEntity="PhotoCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="photo_category", referencedColumnName="id")
     * })
     */
    private $photoCategory;

    public function __construct()
    {
        $this->createdAt = new \DateTime;
        $this->encoded = false;
        $this->hash = md5(srand());
    }

    /**
     * Sets file.
     * @param array $file
     * @return File
     */
    public function setFile($file = null)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * Get file.
     *
     * @return array
     */
    public function getFile()
    {
        return $this->file;
    }

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
     * @return Photo
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
     * Set description
     *
     * @param string $description
     * @return Photo
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Photo
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
     * Set status
     *
     * @param boolean $status
     * @return Photo
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set hash
     *
     * @param string $hash
     * @return Photo
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set author
     *
     * @param \Sadbot\Bundle\UserBundle\Entity\User $author
     * @return Photo
     */
    public function setAuthor(\Sadbot\Bundle\UserBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Sadbot\Bundle\UserBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set photoCategory
     *
     * @param \Sadbot\Bundle\VideoBundle\Entity\PhotoCategory $photoCategory
     * @return Photo
     */
    public function setPhotoCategory(\Sadbot\Bundle\VideoBundle\Entity\PhotoCategory $photoCategory = null)
    {
        $this->photoCategory = $photoCategory;

        return $this;
    }

    /**
     * Get photoCategory
     *
     * @return \Sadbot\Bundle\VideoBundle\Entity\PhotoCategory
     */
    public function getPhotoCategory()
    {
        return $this->photoCategory;
    }
}