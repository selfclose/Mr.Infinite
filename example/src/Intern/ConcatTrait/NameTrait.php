<?php

namespace Intern\ConcatTrait;

trait NameTrait
{
    /**
     * @return string
     */
    public function getName($lang = 'th_TH')
    {
        return $this->dataModel['name_'.$lang];
    }

    /**
     * @param string $name
     */
    public function setName($name, $lang = 'th_TH')
    {
        $this->dataModel['name_'.$lang] = $name;
    }
}
