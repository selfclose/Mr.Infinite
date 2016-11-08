<?php
namespace Intern\Model;

/**
 * Class Skill
 * @package Intern\Model
 * @property int id
 * @property int type_id
 * @property string name
 */
class Skill
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $type_id;

    /**
     * @var string
     */
    protected $name;

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return int
	 */
	public function getTypeId() {
		return $this->type_id;
	}

	/**
	 * @param int $type_id
	 */
	public function setTypeId( $type_id ) {
		$this->type_id = $type_id;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName( $name ) {
		$this->name = $name;
	}
}
