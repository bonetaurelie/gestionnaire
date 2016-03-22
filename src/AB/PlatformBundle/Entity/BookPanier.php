<?php

namespace AB\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookPanier
 *
 * @ORM\Table(name="book_panier")
 * @ORM\Entity(repositoryClass="AB\PlatformBundle\Repository\BookPanierRepository")
 */
class BookPanier
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
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="Book", inversedBy="paniers",cascade={"persist"})
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id")
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity="Panier", inversedBy="books",cascade={"persist"})
     * @ORM\JoinColumn(name="panier_id", referencedColumnName="id")
     */
    private $panier;

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
     * Set quantite
     *
     * @param integer $quantite
     * @return BookPanier
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set book
     *
     * @param \AB\PlatformBundle\Entity\Book $book
     * @return BookPanier
     */
    public function setBook(\AB\PlatformBundle\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book
     *
     * @return \AB\PlatformBundle\Entity\Book 
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set panier
     *
     * @param \AB\PlatformBundle\Entity\Panier $panier
     * @return BookPanier
     */
    public function setPanier(\AB\PlatformBundle\Entity\Panier $panier = null)
    {
        $this->panier = $panier;

        return $this;
    }

    /**
     * Get panier
     *
     * @return \AB\PlatformBundle\Entity\Panier 
     */
    public function getPanier()
    {
        return $this->panier;
    }
}
