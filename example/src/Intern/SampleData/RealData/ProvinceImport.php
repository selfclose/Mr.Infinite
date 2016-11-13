<?php
namespace Intern\SampleData\RealData;

use Intern\Model\Province;

class ProvinceImport
{
    private $records = [
        [10,'กรุงเทพมหานคร','Bangkok',2],
        [11,'สมุทรปราการ','Samut Prakan',2],
        [12,'นนทบุรี','Nonthaburi',2],
        [13,'ปทุมธานี','PathumThani',2],
        [14,'พระนครศรีอยุธยา','PhraNakhonSiAyutthaya',2],
        [15,'อ่างทอง','AngThong',2],
        [16,'ลพบุรี','Loburi',2],
        [17,'สิงห์บุรี','SingBuri',2],
        [18,'ชัยนาท','ChaiNat',2],
        [19,'สระบุรี','Saraburi',2],
        [20,'ชลบุรี','ChonBuri',5],
        [21,'ระยอง','Rayong',5],
        [22,'จันทบุรี','Chanthaburi',5],
        [23,'ตราด','Trat',5],
        [24,'ฉะเชิงเทรา','Chachoengsao',5],
        [25,'ปราจีนบุรี','PrachinBuri',5],
        [26,'นครนายก','NakhonNayok',2],
        [27,'สระแก้ว','SaKaeo',5],
        [28,'นครราชสีมา','NakhonRatchasima',3],
        [29,'บุรีรัมย์','BuriRam',3],
        [30,'สุรินทร์','Surin',3],
        [31,'ศรีสะเกษ','SiSaKet',3],
        [32,'อุบลราชธานี','UbonRatchathani',3],
        [33,'ยโสธร','Yasothon',3],
        [34,'ชัยภูมิ','Chaiyaphum',3],
        [35,'อำนาจเจริญ','AmnatCharoen',3],
        [36,'หนองบัวลำภู','NongBuaLamPhu',3],
        [37,'ขอนแก่น','KhonKaen',3],
        [38,'อุดรธานี','UdonThani',3],
        [39,'เลย','Loei',3],
        [40,'หนองคาย','NongKhai',3],
        [41,'มหาสารคาม','MahaSarakham',3],
        [42,'ร้อยเอ็ด','RoiEt',3],
        [43,'กาฬสินธุ์','Kalasin',3],
        [44,'สกลนคร','SakonNakhon',3],
        [45,'นครพนม','NakhonPhanom',3],
        [46,'มุกดาหาร','Mukdahan',3],
        [47,'เชียงใหม่','ChiangMai',1],
        [48,'ลำพูน','Lamphun',1],
        [49,'ลำปาง','Lampang',1],
        [50,'อุตรดิตถ์','Uttaradit',1],
        [51,'แพร่','Phrae',1],
        [52,'น่าน','Nan',1],
        [53,'พะเยา','Phayao',1],
        [54,'เชียงราย','ChiangRai',1],
        [55,'แม่ฮ่องสอน','MaeHongSon',1],
        [56,'นครสวรรค์','NakhonSawan',2],
        [57,'อุทัยธานี','UthaiThani',2],
        [58,'กำแพงเพชร','KamphaengPhet',2],
        [59,'ตาก','Tak',4],
        [60,'สุโขทัย','Sukhothai',2],
        [61,'พิษณุโลก','Phitsanulok',2],
        [62,'พิจิตร','Phichit',2],
        [63,'เพชรบูรณ์','Phetchabun',2],
        [64,'ราชบุรี','Ratchaburi',4],
        [65,'กาญจนบุรี','Kanchanaburi',4],
        [66,'สุพรรณบุรี','SuphanBuri',2],
        [67,'นครปฐม','NakhonPathom',2],
        [68,'สมุทรสาคร','SamutSakhon',2],
        [69,'สมุทรสงคราม','SamutSongkhram',2],
        [70,'เพชรบุรี','Phetchaburi',4],
        [71,'ประจวบคีรีขันธ์','PrachuapKhiriKhan',4],
        [72,'นครศรีธรรมราช','NakhonSiThammarat',6],
        [73,'กระบี่','Krabi',6],
        [74,'พังงา','Phangnga',6],
        [75,'ภูเก็ต','Phuket',6],
        [76,'สุราษฎร์ธานี','SuratThani',6],
        [77,'ระนอง','Ranong',6],
        [78,'ชุมพร','Chumphon',6],
        [79,'สงขลา','Songkhla',6],
        [80,'สตูล','Satun',6],
        [81,'ตรัง','Trang',6],
        [82,'พัทลุง','Phatthalung',6],
        [83,'ปัตตานี','Pattani',6],
        [84,'ยะลา','Yala',6],
        [85,'นราธิวาส','Narathiwat',6],
        [86,'บึงกาฬ','buogkan',3],
    ];

    function __construct()
    {
        iLog('--- Importing Province ---', true);
        foreach ($this->records as $record) {
            $province = new Province();
            $province->setProvinceId($record[0]);
            $province->setName($record[1]);
            $province->setName($record[2], 'en');
            $province->setGeoId($record[3]);
            if ($province->insertAction()) {
                iLog('* Inserted Province: '.$record[1]);
            }
        }
    }
}
