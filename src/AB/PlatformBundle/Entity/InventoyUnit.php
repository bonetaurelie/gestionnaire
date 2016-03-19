<?php


namespace AB\Platform\Entity;

use Sylius\Bundle\InventoryBundle\Entity\InventoryUnit as BaseInventoryUnit;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="app_inventory_unit")
 */
class InventoryUnit extends BaseInventoryUnit
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}