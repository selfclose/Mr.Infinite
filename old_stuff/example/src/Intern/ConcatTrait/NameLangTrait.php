<?php

namespace Intern\ConcatTrait;

trait NameLangTrait
{
    /**
     * @return string
     */
    public function getName($lang = 'th')
    {
        return $this->dataModel['name_'.$lang];
    }

    /**
     * @param string $name
     */
    public function setName($name, $lang = 'th')
    {
        $this->dataModel['name_'.$lang] = $name;
    }
}
