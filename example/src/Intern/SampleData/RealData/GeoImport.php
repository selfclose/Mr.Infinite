<?php
namespace Intern\SampleData\RealData;

class GeoImport
{
    private $records = [
        'ภาคเหนือ', 'ภาคกลาง', 'ภาคตะวันออกเฉียงเหนือ', 'ภาคตะวันตก', 'ภาคตะวันออก', 'ภาคใต้'
    ];

    function __construct()
    {
        foreach ($this->records as $record) {
            $geo = new \Intern\Model\Geo();

            $geo->setName($record);

            if ($geo->insertAction()) {
                echo "<p>Inserted Geo: ".$record."</p>";
            }
        }
    }
}
