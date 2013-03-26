<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Persons entity class.
 *
 * Annotations define the entity mappings to database.
 *
 * @ORM\Entity
 * @ORM\Table(name="ImageUploader_Fields")
 */
class ImageUploader_Entity_Fields extends Zikula_EntityAccess
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
	private $fid;

	/**
	 * The following are annotations which define the uid field.
	 *
	 * @ORM\Column(type="string", length="255")
	 */
	private $module;

	/**
	 * The following are annotations which define the openly field.
	 *
	 * @ORM\Column(type="string", length="255")
	 */
	private $type;

	/**
	 * The following are annotations which define the fileextension field.
	 *
	 * @ORM\Column(type="string", length="255")
	 */
	private $func;

	/**
	 * The following are annotations which define the height field.
	 *
	 * @ORM\Column(type="integer")
	 */
	private $editor;


	public function getId()
	{
		return $this->id;
	}

	public function getFid()
	{
		return $this->fid;
	}

	public function getModule()
	{
		return $this->module;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getFunc()
	{
		return $this->func;
	}

	public function getEditor()
	{
		return $this->editor;
	}

	public function setFid($val)
	{
		$this->fid = $val;
	}

	public function setModule($val)
	{
		$this->module = $val;
	}

	public function setType($val)
	{
		$this->type = $val;
	}

	public function setFunc($val)
	{
		$this->func = $val;
	}

	public function setEditor($val)
	{
		$this->editor = $val;
	}

}
