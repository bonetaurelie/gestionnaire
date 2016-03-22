<?php

namespace AB\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="panier")
 * @ORM\Entity(repositoryClass="AB\PlatformBundle\Repository\PanierRepository")
 */
class Panier
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
     * @ORM\OneToMany(targetEntity="BookPanier", mappedBy="panier")
     */
    private $books;

    /**
     * @var \Datetime
     *
     * @ORM\Column(name="date", type="datetime")
     *
     */
    private $date;

    public function __construct()
    {
        $this->date= new \DateTime();
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set date
     *
     * @param \DateTime $date
     * @return Panier
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * Add books
     *
     * @param \AB\PlatformBundle\Entity\BookPanier $books
     * @return Panier
     */
    public function addBook(\AB\PlatformBundle\Entity\BookPanier $books)
    {
        $this->books[] = $books;

        return $this;
    }

    /**
     * Remove books
     *
     * @param \AB\PlatformBundle\Entity\BookPanier $books
     */
    public function removeBook(\AB\PlatformBundle\Entity\BookPanier $books)
    {
        $this->books->removeElement($books);
    }

    /**
     * Get books
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBooks()
    {
        return $this->books;
    }
}
