<?php
namespace Intern\SampleData\RealData;

use Intern\Model\Skill;
use Intern\Model\SkillType;

class SkillImport
{
    private $records = [
        'Design / Creative' => [
            '3D animation',
            '3D rendering',
            'Adobe photoshop',
            'Adobe illustrator',
            'Adobe indesign',
            'Adobe Dreamweaver',
            'After Effects',
            'Architecture',
            'Brain Storming',
            'Branding',
            'Copy Editing',
            'Copywriting',
            'Creative Presentation',
            'Email Marketing/Newsletters',
            'Facebook Marketing',
            'Fashion Design',
            'Final Cut Pro',
            'Flash',
            'Furniture Design',
            'Google Adsense',
            'Google Adwords',
            'Handcrafts',
            'Industrial Design',
            'Market Research',
            'Material Design',
            'Maya',
            'Packaging Design',
            'Photo Editing',
            'Publishing',
            'Social Media Management',
            'Typography',
            'Video Broadcasting',
            'Video Editing',
            'Videography',
            'Viral Marketing'
        ],
        'IT' => [
            'Android',
            'ASP.NET',
            'Apache',
            'C',
            'C#',
            'C++',
            'Computer Graphics',
            'CSS',
            'Data Warehousing',
            'Database Development',
            'eCommerce',
            'Google Chrome',
            'HTML 5',
            'Javascript',
            'Java',
            'Mac OS',
            'Microsoft Access',
            'Microsoft office',
            'Microsoft SQL Server',
            'Mysql',
            '.NET',
            'Oracle',
            'PHP',
            'SQL',
            'Social media',
            'VB.NET',
            'VMware',
            'Visual Basic',
            'Twitter',
            'Wordpress',
            'Windows Server',
            'Windows API',
            'XML',
            'YouTube'
        ],
        'General Skills' => [
            'Analytical Thinking',
            'Creative Writing',
            'Diplomacy',
            'Energetic',
            'Enthusiastic',
            'Fast Learner',
            'Good communication Skills',
            'High Responsibilities',
            'Leadership Skills',
            'Meet Deadlines',
            'Multitasking',
            'News Reporting',
            'Outgoing Personality',
            'Pleasant Personality',
            'Positive Thinker',
            'Problem Solving',
            'Producing Reports',
            'Public Speaking',
            'Punctual',
            'Service-Minded',
            'Teaching',
            'Teamwork',
            'willing to work overtime',
            'work well under pressure'
        ],
        'Business' => [
            'Business Statistics/Analysis',
            'Contracts',
            'Corporate Law',
            'Event Planning',
            'Excel & Data Entry',
            'Human Resource Management',
            'Inventory / Warehouse Management',
            'Management',
            'Market Analysis',
            'Negotiation',
            'Payroll',
            'Procurement',
            'Project Management',
            'Property Management / Development',
            'Public Relations',
            'Recruitment',
            'Sales'
        ],
        'Engineering' => [
            'Automation',
            'Biology',
            'CAD',
            'Civil Engineering',
            'Construction Monitoring',
            'Electronics',
            'Geolocation',
            'Instrument',
            'Mechanical',
            'Quality Management System',
            'SAP System',
            'Statistics',
            'Chemical'
        ],
        'Finance' => [
            'Accounting',
            'Assurance',
            'Budgeting',
            'CAESAR',
            'Cash Flow Management',
            'CFA ',
            'CFP ',
            'Cost Analysis',
            'Derivative License',
            'Finance',
            'Financial Modeling',
            'IC License',
            'IP License',
            'M&A',
            'Quantitative Analysis',
            'Risk Management',
            'Single License',
            'Taxation',
            'Valuation Techniques'
        ],
        'Job Objective' => [
            'Ability to travel upcountry',
            'Attend Workshops (Industry specific)',
            'Industry trends',
            'Own Transportation and Driving Licence',
            'Personal networks',
            'Professional publication'
        ],
        'Science' => [
            'BRC Global Standard',
            'Certification',
            'Chemical Processing',
            'EHS Management',
            'GMP',
            'HACCP',
            'ISO/ TS16949',
            'ISO 14001',
            'ISO 15189:2008',
            'ISO 18001',
            'ISO 9001',
            'Laboratory equipment calibration',
            'Laboratory instruments expertise',
            'Neuroscience',
            'Nutricion',
            'OHSAS 18001',
            'Petrochemical',
            'Product Development',
            'Product Testing',
            'Quality Assurance',
            'Research',
            'Safety Management'
        ]
    ];

    function __construct()
    {
        iLog('--- Importing Skill ---', true);

        //Style 1
//        foreach ($this->records as $key => $val) {
//            $skillType = new SkillType();
//            $skillType->setName($key);
//            $skillType->insertAction();
//
//            iLog('--- Inserted Skill Type: '.$key.' ---', true);
//
//            foreach ($val as $sk) {
//                $skill = new Skill();
//                $skill->setName($sk);
//                $skill->setSkillType(array_search($key,array_keys($this->records))+1); //+1 cuz table id start with 1
//                $skill->insertAction();
//                iLog('* Inserted Skill: '.$sk);
//            }
//        }

        //Style 2
        foreach ($this->records as $key => $val) {
            $skillType = new SkillType();
            $skillType->setName($key);

            foreach ($val as $sk) {

                $skill = new Skill();
                $skill->setName($sk);
                $skillID = $skill->insertAction();

                iLog('* Inserted Skill: '.$sk);

                $skillType->addSkill($skillID);
            }
            $skillType->insertAction();
            iLog('* Inserted Skill Type: '.$key);
        }

    }
}
