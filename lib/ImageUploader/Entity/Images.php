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
	 * @ORM\Column(type="string", length="255")
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
	 * @ORM\Column(type="boolean")
	 */
	private $openly;

	/**
	 * The following are annotations which define the fileextension field.
	 *
	 * @ORM\Column(type="string", length="13")
	 */
	private $fileextension;

	/**
	 * The following are annotations which define the height field.
	 *
	 * @ORM\Column(type="integer")
	 */
	private $height;

	/**
	 * The following are annotations which define the width field.
	 *
	 * @ORM\Column(type="integer")
	 */
	private $width;

	/**
	 * The following are annotations which define the removed field.
	 *
	 * @ORM\Column(type="boolean")
	 */
	private $removed;

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

	public function getFileextension()
	{
		return $this->fileextension;
	}

	public function getHeight()
	{
		return $this->height;
	}

	public function getWidth()
	{
		return $this->width;
	}

	public function getRemoved()
	{
		return $this->removed;
	}

	public function getConfig()
	{
		return $this->config;
	}

	public function setUid($uid)
	{
		$this->uid = $uid;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function setOpenly($openly)
	{
		$this->openly = $openly;
	}

	public function setFileextension($fe)
	{
		$this->fileextension = $fe;
	}

	public function setHeight($height)
	{
		$this->height = $height;
	}

	public function setWidth($width)
	{
		$this->width = $width;
	}

	public function setRemoved($removed)
	{
		$this->removed = $removed;
	}

	public function setConfig($config)
	{
		$this->config = $config;
	}

}
