<?php

namespace GoSoft\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * GoSoft\MainBundle\Entity\Application
 *
 * @ORM\Table(name="gosoft_applications")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="GoSoft\MainBundle\Entity\ApplicationRepository")
 */
class Application
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nom
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\MinLength(limit = 2, message = "Le nom de famille doit avoir au moins {{ limit }} caractères")
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="GoSoft\UserBundle\Entity\User", inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Type(type="GoSoft\UserBundle\Entity\User")
     */
    private $user;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank(message="Veuillez renplir une description")
     */
    private $description;

    /**
     * @var decimal $prix
     *
     * @ORM\Column(name="prix", type="decimal", scale=2)
     * @Assert\NotBlank()
     */
    protected $prix;

    /**
     * @var decimal $prixpromo
     *
     * @ORM\Column(name="prixpromo", type="decimal", scale=2)
     */
    protected $prixpromo;

    /**
     * @var datetime $dateajout
     *
     * @ORM\Column(name="dateajout", type="datetime")
     * @Assert\DateTime()
     */
    private $dateajout;

    /**
     * @var boolean $publication
     * @ORM\Column(name="publication", type="boolean")
     */
    private $publication;

    /**
     * @ORM\ManyToOne(targetEntity="GoSoft\MainBundle\Entity\Categorie", inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @var string $logo
     * @Assert\File( maxSize = "1024k", mimeTypesMessage = "Please upload a valid Image")
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;




    public function __construct()
    {
        $this->dateajout   = new \Datetime;
        $this->publication  = false;
        $this->prixpromo  = 0;
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
     * Set nom
     *
     * @param string $nom
     * @return Application
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Application
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
     * Set prix
     *
     * @param float $prix
     * @return GoSoftApplication
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set publication
     *
     * @param boolean $publication
     * @return Application
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return boolean
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set categorie
     *
     * @param GoSoft\MainBundle\Entity\GoSoftCategorie $categorie
     * @return GoSoftApplication
     */
    public function setCategorie(\GoSoft\MainBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return GoSoft\MainBundle\Entity\GoSoftCategorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set prixpromo
     *
     * @param float $prixpromo
     * @return GoSoftApplication
     */
    public function setPrixpromo($prixpromo)
    {
        $this->prixpromo = $prixpromo;

        return $this;
    }

    /**
     * Get prixpromo
     *
     * @return float
     */
    public function getPrixpromo()
    {
        return $this->prixpromo;
    }

    /**
     * Set dateajout
     *
     * @param \DateTime $dateajout
     * @return Application
     */
    public function setDateajout($dateajout)
    {
        $this->dateajout = $dateajout;

        return $this;
    }

    /**
     * Get dateajout
     *
     * @return \DateTime
     */
    public function getDateajout()
    {
        return $this->dateajout;
    }

    /**
     * Set user
     *
     * @param GoSoft\UserBundle\Entity\User $user
     * @return Application
     */
    public function setUser(\GoSoft\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return GoSoft\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add user
     *
     * @param GoSoft\UserBundle\Entity\User $user
     * @return Application
     */
    public function addUser(\GoSoft\UserBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param GoSoft\UserBundle\Entity\User $user
     */
    public function removeUser(\GoSoft\UserBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }


    public function getFullLogoPath() {
        return null === $this->logo ? null : $this->getUploadRootDir(). $this->logo;
    }

    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return $this->getTmpUploadRootDir().$this->getId()."/";
    }

    protected function getTmpUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/upload/';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function uploadLogo() {
        // the file property can be empty if the field is not required
        if (null === $this->logo) {
            return;
        }
        if(!$this->id){
            $this->logo->move($this->getTmpUploadRootDir(), $this->logo->getClientOriginalName());
        }else{
            $this->logo->move($this->getUploadRootDir(), $this->logo->getClientOriginalName());
        }
        $this->setLogo($this->logo->getClientOriginalName());
    }

    /**
     * @ORM\PostPersist()
     */
    public function moveLogo()
    {
        if (null === $this->logo) {
            return;
        }
        if(!is_dir($this->getUploadRootDir())){
            mkdir($this->getUploadRootDir());
        }
        copy($this->getTmpUploadRootDir().$this->logo, $this->getFullLogoPath());
        unlink($this->getTmpUploadRootDir().$this->logo);
    }

    /**
     * @ORM\PreRemove()
     */
    public function removeLogo()
    {
        unlink($this->getFullLogoPath());
        rmdir($this->getUploadRootDir());
    }
}