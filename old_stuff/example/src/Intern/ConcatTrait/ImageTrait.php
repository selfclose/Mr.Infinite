<?php

namespace Intern\ConcatTrait;

trait ImageTrait
{
    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->dataModel->image;
    }

    /**
     * @param string $url
     */
    public function setImageUrl($url)
    {
        $this->dataModel->image = $url;
    }

}
