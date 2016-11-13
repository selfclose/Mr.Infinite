<?php
namespace Intern\SampleData\RealData;

use Intern\Model\Badge;
use Intern\Model\Skill;
use Intern\Model\SkillType;

class BadgeImport
{
    private $records = [
        'ทำ Resume เกิน 80%',
        'สมาชิกดีเด่น',
        'บริษัทชมเชย',
    ];

    function __construct()
    {
        iLog('--- Importing Badge ---', true);

        foreach ($this->records as $record) {
            $badge = new Badge();
            $badge->setName($record);
            
            iLog('* Inserted Badge: '.$record);
            $badge->insertAction();
        }
    }
}
