<?php

namespace AB\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="AB\PlatformBundle\Repository\BookRepository")
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
     * @Assert\Length(min=10)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     * @Assert\Length(min=10)
     */
    private $auteur;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     * @Assert\Range(min=1)
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite_dispo", type="integer")
     * @Assert\Range(min=1)
     */
    private $quantiteDispo;

    /**
     * @var date
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    public function __construct()
    {
        $this->date= new \DateTime();
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
    public function setQuantiteDispo($quantiteDispo)
    {
        $this->quantiteDispo = $quantiteDispo;

        return $this;
    }

    /**
     * Get quantiteDispo
     *
     * @return integer 
     */
    public function getQuantiteDispo()
    {
        return $this->quantiteDispo;
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
        return $this->Date;
    }
}
