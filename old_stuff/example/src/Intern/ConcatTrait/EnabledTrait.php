<?php

namespace Intern\ConcatTrait;

trait EnabledTrait
{
    /**
     * @return bool
     */
    public function getEnabled()
    {
        return $this->dataModel->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled = true)
    {
        $this->dataModel->enabled = $enabled;
    }

}
