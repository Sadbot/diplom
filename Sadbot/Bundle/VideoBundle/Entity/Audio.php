<?php

namespace Sadbot\Bundle\VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Iphp\FileStoreBundle\Mapping\Annotation as FileStore;

/**
 * Audio
 *
 * @ORM\Table(name="audio", indexes={@ORM\Index(name="audio_author_idx", columns={"author"}), @ORM\Index(name="audio_category_idx", columns={"audio_category"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Sadbot\Bundle\VideoBundle\Entity\AudioRepository")
 * @FileStore\Uploadable
 */
class Audio
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
     * @var boolean
     *
     * @ORM\Column(name="encoded", type="boolean", nullable=false)
     */
    private $encoded;

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
     *      maxSize = "17M",
     *      maxSizeMessage = "Слишком большой файл",
     *      mimeTypes = {"audio/mpeg","audio/ogg"},
     *      mimeTypesMessage = "Загрузите аудио."
     * )
     * @FileStore\UploadableField(mapping="audio")
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
     * @var \AudioCategory
     *
     * @ORM\ManyToOne(targetEntity="AudioCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="audio_category", referencedColumnName="id")
     * })
     */
    private $audioCategory;

    public function __construct()
    {
        $this->createdAt = new \DateTime;
        $this->encoded = false;
        $this->hash = md5(srand());
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile($file = null)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
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
     * @return Audio
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
     * @return Audio
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
     * Set encoded
     *
     * @param boolean $encoded
     * @return Audio
     */
    public function setEncoded($encoded)
    {
        $this->encoded = $encoded;

        return $this;
    }

    /**
     * Get encoded
     *
     * @return boolean 
     */
    public function getEncoded()
    {
        return $this->encoded;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Audio
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
     * @return Audio
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
     * Set author
     *
     * @param \Sadbot\Bundle\UserBundle\Entity\User $author
     * @return Audio
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
     * Set audioCategory
     *
     * @param \Sadbot\Bundle\VideoBundle\Entity\AudioCategory $audioCategory
     * @return Audio
     */
    public function setAudioCategory(\Sadbot\Bundle\VideoBundle\Entity\AudioCategory $audioCategory = null)
    {
        $this->audioCategory = $audioCategory;

        return $this;
    }

    /**
     * Get audioCategory
     *
     * @return \Sadbot\Bundle\VideoBundle\Entity\AudioCategory 
     */
    public function getAudioCategory()
    {
        return $this->audioCategory;
    }

    /**
     * @return boolean
     */
    public function isHash()
    {
        return $this->hash;
    }

    /**
     * @param boolean $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }


}
