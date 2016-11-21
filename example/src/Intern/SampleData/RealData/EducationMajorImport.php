<?php
namespace Intern\SampleData\RealData;

use Intern\Model\Company;
use Intern\Model\EducationMajor;
use Intern\Model\Job;
use Intern\Model\JobTag;
use Intern\Model\JobType;
use Intern\Provider\DateTimeProvider;

class EducationMajorImport extends DateTimeProvider
{
    private $records =
        [
            'เกษตรศาสตร์',
            'สัตวศาสตร์',
            'ประมง',
            'ทรัพยากรธรรมชาติและสิ่งแวดล้อม',
            'เทคโนโลยีและการพัฒนาชุมชน',

            'บริหารธุรกิจ',
            'พาณิชยศาสตร์และการบัญชี',
            'วิทยาการจัดการ',
            'บัญชีและการเงินธุรกิจ',

            'เศรษฐศาสตร์',

            'มนุษยศาสตร์',
            'ศิลปศาสตร์',
            'อักษรศาสตร์',
            'โบราณคดี',
            'ครุศาสตร์อุตสาหกรร',

            'นิติศาสตร์',
            'รัฐศาสตร์',
            'รัฐประศาสนศาสตร์',
            'สังคมศาสตร์',
            'สังคมสงเคราะห์ศาสตร์',

            'นิเทศศาสตร์',
            'วารสารศาสตร์และสื่อสารมวลชน',

            'ในกลุ่มวิทยาศาสตร์',
            'เทคโนโลยีสารสนเทศ',
            'วิศวกรรมศาสตร์',
            'ศิลปกรรมศาสตร์',

            'ครุศาสตร์',
            'ครุศาสตร์อุตสาหกรรม',
            'ศึกษาศาสตร์',
            'พลศึกษา',

            'สถาปัตยกรรมศาสตร์',

            'แพทยศาสตร์',
            'พยาบาลศาสตร์',
            'เวชศาสตร์เขตร้อน',
            'เภสัชศาสตร์',
            'สาธารณสุขศาสตร์',
            'ทันตแพทยศาสตร์',
            'สัตวแพทยศาสตร์',

            'เทคนิคการแพทย์',
            'กายภาพบำบัด',
            'สหเวชศาสตร์',
            'ทัศนมาตรศาสตร์',

            'พลศึกษา',
            'วิทยาศาสตร์การกีฬา',
        ];

    function __construct()
    {
        iLog('--- Importing Major ---', true);

        foreach ($this->records as $record) {
            $data = new EducationMajor();
            $data->setName($record);

            if ($data->insertAction()) {
                iLog('* Inserted Major : '.$data->getName());
            }
        }
    }
}
