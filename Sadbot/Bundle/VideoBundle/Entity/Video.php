<?php

namespace Sadbot\Bundle\VideoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Iphp\FileStoreBundle\Mapping\Annotation as FileStore;

/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity(repositoryClass="Sadbot\Bundle\VideoBundle\Entity\VideoRepository")
 * @FileStore\Uploadable
 */
class Video
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    protected $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="encoded", type="boolean", nullable=false)
     */
    protected $encoded;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    protected $status;

    /**
     * @var
     * @ORM\Column(type="array")
     * @Assert\File(
     *      maxSize = "200M",
     *      maxSizeMessage = "Слишком большой файл",
     *      mimeTypes = {"video/mpeg", "video/mp4", "video/webm", "video/x-flv"},
     *      mimeTypesMessage = "Поддерживается загрузка файловых типов mpg4, avi, webm."
     * )
     * @FileStore\UploadableField(mapping="video")
     */
    protected $video;

    /**
     * @var
     * @ORM\Column(type="array")
     * @Assert\File(
     *      maxSize = "5M",
     *      maxSizeMessage = "Слишком большой файл",
     *      mimeTypes = {"image/jpeg"},
     *      mimeTypesMessage = "Поддерживается загрузка файловых типов jpg."
     * )
     * @FileStore\UploadableField(mapping="thumb")
     */
    protected $image;

    /**
     * @var \Application\Sonata\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="author", referencedColumnName="id")
     * })
     */
    protected $author;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", cascade={"persist"})
     * @ORM\JoinTable(name="videos_tags",
     *      joinColumns={@ORM\JoinColumn(name="video_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     **/
    protected $tags;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hash", type="string", length=255, nullable=false)
     */
    protected $hash;

    public function __construct()
    {
        $this->createdAt = new \DateTime;
        $this->encoded = false;
        $this->hash = md5(srand());
    }

    /**
     * @param  $video
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }

    /**
     * @return $video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param  $video
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return $video
     */
    public function getImage()
    {
        return $this->image;
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
     * @return Video
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
     * @return Video
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
     * @return Video
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
     * @return Video
     */
    public function setCreatedAt($createdAt=null)
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
     * @return Video
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
     * @param \Application\Sonata\UserBundle\Entity\User $author
     * @return Video
     */
    public function setAuthor(\Application\Sonata\UserBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add tags
     *
     * @param \Sadbot\Bundle\VideoBundle\Entity\Tag $tags
     * @return Video
     */
    public function addTag(\Sadbot\Bundle\VideoBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Sadbot\Bundle\VideoBundle\Entity\Tag $tags
     */
    public function removeTag(\Sadbot\Bundle\VideoBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
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
