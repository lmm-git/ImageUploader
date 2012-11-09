<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Persons entity class.
 *
 * Annotations define the entity mappings to database.
 *
 * @ORM\Entity
 * @ORM\Table(name="ImageUploader_Images")
 */
class ImageUploader_Entity_Images extends Zikula_EntityAccess
{

	/**
	 * The following are annotations which define the id field.
	 *
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;


	/**
	 * The following are annotations which define the id field.
	 *
	 * @ORM\Column(type="title")
	 */
	private $title;

	/**
	 * The following are annotations which define the uid field.
	 *
	 * @ORM\Column(type="integer")
	 */
	private $uid;

	/**
	 * The following are annotations which define the openly field.
	 *
	 * @ORM\Column(type="bool")
	 */
	private $openly;

	/**
	 * The following are annotations which define the config field.
	 * @ORM\Column(type="array")
	 */
	private $config;


	public function getId()
	{
		return $this->id;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getUid()
	{
		return $this->uid;
	}

	public function getOpenly()
	{
		return $this->openly;
	}

	public function getConfig()
	{
		return $this->config;
	}

	public function setUid($uid)
	{
		$this->uid = $uid;
	}

	public function setOpenly($openly)
	{
		$this->openly = $openly;
	}

	public function setConfig($config)
	{
		$this->config = $config;
	}

}
