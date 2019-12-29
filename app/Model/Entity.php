<?php
namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/** @Doctrine\ORM\Mapping\MappedSuperclass */
abstract class Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="deleted", type="boolean", options={"default" : false})
     */
    protected $deleted;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="boolean", options={"default" : true})
     */
    protected $status;

    /**
     * @var string
     *
     * @ORM\Column(name="date_added", type="datetime")
     */
    protected $date_added;

    /**
     * @var string
     *
     * @ORM\Column(name="date_modified", type="datetime")
     */
    protected $date_modified;
}
