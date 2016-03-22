<?php

namespace AB\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="AB\PlatformBundle\Repository\BookRepository")
 *
 */
class Book
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="text", unique=false)
     *
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     *
     */
    private $auteur;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     *
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     *
     */
    private $quantite;

    /**
     * @var date
     *
     * @ORM\Column(name="date", type="date")
     *
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity="BookPanier", mappedBy="book")
     */
    private $paniers;

    public function __construct()
    {
        $this->date= new \DateTime();
        $this->paniers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set titre
     *
     * @param string $titre
     * @return Book
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     * @return Book
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set prix
     *
     * @param float $prix
     * @return Book
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
     * Set quantiteDispo
     *
     * @param integer $quantiteDispo
     * @return Book
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantiteDispo
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set date
     *
     * @param date $date
     * @return Book
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add paniers
     *
     * @param \AB\PlatformBundle\Entity\BookPanier $paniers
     * @return Book
     */
    public function addPanier(\AB\PlatformBundle\Entity\BookPanier $paniers)
    {
        $this->paniers[] = $paniers;

        return $this;
    }

    /**
     * Remove paniers
     *
     * @param \AB\PlatformBundle\Entity\BookPanier $paniers
     */
    public function removePanier(\AB\PlatformBundle\Entity\BookPanier $paniers)
    {
        $this->paniers->removeElement($paniers);
    }

    /**
     * Get paniers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPaniers()
    {
        return $this->paniers;
    }
}
