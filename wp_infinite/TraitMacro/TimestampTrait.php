<?php
namespace wp_infinite\TraitMacro;

trait TimestampTrait
{
    protected $created_at;
    protected $updated_at;

//    public function addTimestamp()
//    {
//        $this->addBeforeUpdateAction(function () {
//            $this->setUpdatedAt($this->getCurrentTime());
//        });
//    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_time)
    {
        $this->created_at = $created_time;
    }

    public function getUpdatedAt()
    {
        return $this->created_at;
    }

    public function setUpdatedAt($created_time)
    {
        $this->created_at = $created_time;
    }

    public function __onInsertAction()
    {
        $this->created_at = $this->getCurrentTime();
        $this->updated_at = $this->getCurrentTime();
    }

    public function __onUpdateAction()
    {
        $this->updated_at = $this->getCurrentTime();
    }
}
