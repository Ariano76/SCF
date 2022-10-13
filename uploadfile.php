<?php include("administrador/template/cabecera.php"); ?>

<?php
use Phppot\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require_once './administrador/config/bd.php';
require_once './administrador/config/bdPDO.php';
$db = new DataSource();
$conn = $db->getConnection();

$db_1 = new TransactionSCI();
$conn_1 = $db_1->Connect();

//echo $insertId;

require_once ('./vendor/autoload.php');

if (isset($_POST["import"])) {

    //limpiar tabla stage
    

  $allowedFileType = [
    'application/vnd.ms-excel', 'text/xls', 'text/xlsx',
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
  ];

  if (in_array($_FILES["file"]["type"], $allowedFileType)) {

    $targetPath = 'uploads/' . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

    $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

    $spreadSheet = $Reader->load($targetPath);
    $excelSheet = $spreadSheet->getActiveSheet();
    $spreadSheetAry = $excelSheet->toArray();
    $sheetCount = count($spreadSheetAry);

    $insertId = $db_1->limpiarStage("SP_LimpiarTablaStage",$nombreUsuario);
    $conta=0;
    //for ($i = 0; $i <= $sheetCount; $i ++) {
    for ($i = 1; $i < $sheetCount; $i ++) {
        $dato_01 = "";
        if (isset($spreadSheetAry[$i][0])) {
            $dato_01  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]); }
        $dato_02 = "";
        if (isset($spreadSheetAry[$i][1])) {
            $dato_02  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]); }
        $dato_03 = "";
        if (isset($spreadSheetAry[$i][2])) {
            $dato_03  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][2]); }
        $dato_04 = "";
        if (isset($spreadSheetAry[$i][3])) {
            $dato_04  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][3]); }
        $dato_05 = "";
        if (isset($spreadSheetAry[$i][4])) {
            $dato_05  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][4]); }
        $dato_06 = "";
        if (isset($spreadSheetAry[$i][5])) {
            $dato_06  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][5]); }
        $dato_07 = "";
        if (isset($spreadSheetAry[$i][6])) {
            $dato_07  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][6]); }
        $dato_08 = "";
        if (isset($spreadSheetAry[$i][7])) {
            $dato_08  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][7]); }
        $dato_09 = "";
        if (isset($spreadSheetAry[$i][8])) {
            $dato_09  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][8]); }
        $dato_10 = "";
        if (isset($spreadSheetAry[$i][9])) {
            $dato_10  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][9]); }
        $dato_11 = "";
        if (isset($spreadSheetAry[$i][10])) {
            $dato_11  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][10]); }
        $dato_12 = "";
        if (isset($spreadSheetAry[$i][11])) {
            $dato_12  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][11]); }
        $dato_13 = "";
        if (isset($spreadSheetAry[$i][12])) {
            $dato_13  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][12]); }
        $dato_14 = "";
        if (isset($spreadSheetAry[$i][13])) {
            $dato_14  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][13]); }
        $dato_15 = "";
        if (isset($spreadSheetAry[$i][14])) {
            $dato_15  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][14]); }
        $dato_16 = "";
        if (isset($spreadSheetAry[$i][15])) {
            $dato_16  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][15]); }
        $dato_17 = "";
        if (isset($spreadSheetAry[$i][16])) {
            $dato_17  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][16]); }
        $dato_18 = "";
        if (isset($spreadSheetAry[$i][17])) {
            $dato_18  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][17]); }
        $dato_19 = "";
        if (isset($spreadSheetAry[$i][18])) {
            $dato_19  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][18]); }
        $dato_20 = "";
        if (isset($spreadSheetAry[$i][19])) {
            $dato_20  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][19]); }
        $dato_21 = "";
        if (isset($spreadSheetAry[$i][20])) {
            $dato_21  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][20]); }
        $dato_22 = "";
        if (isset($spreadSheetAry[$i][21])) {
            $dato_22  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][21]); }
        $dato_23 = "";
        if (isset($spreadSheetAry[$i][22])) {
            $dato_23  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][22]); }
        $dato_24 = "";
        if (isset($spreadSheetAry[$i][23])) {
            $dato_24  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][23]); }
        $dato_25 = "";
        if (isset($spreadSheetAry[$i][24])) {
            $dato_25  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][24]); }
        $dato_26 = "";
        if (isset($spreadSheetAry[$i][25])) {
            $dato_26  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][25]); }
        $dato_27 = "";
        if (isset($spreadSheetAry[$i][26])) {
            $dato_27  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][26]); }
        $dato_28 = "";
        if (isset($spreadSheetAry[$i][27])) {
            $dato_28  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][27]); }
        $dato_29 = "";
        if (isset($spreadSheetAry[$i][28])) {
            $dato_29  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][28]); }
        $dato_30 = "";
        if (isset($spreadSheetAry[$i][29])) {
            $dato_30  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][29]); }
        $dato_31 = "";
        if (isset($spreadSheetAry[$i][30])) {
            $dato_31  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][30]); }
        $dato_32 = "";
        if (isset($spreadSheetAry[$i][31])) {
            $dato_32  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][31]); }
        $dato_33 = "";
        if (isset($spreadSheetAry[$i][32])) {
            $dato_33  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][32]); }
        $dato_34 = "";
        if (isset($spreadSheetAry[$i][33])) {
            $dato_34  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][33]); }
        $dato_35 = "";
        if (isset($spreadSheetAry[$i][34])) {
            $dato_35  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][34]); }
        $dato_36 = "";
        if (isset($spreadSheetAry[$i][35])) {
            $dato_36  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][35]); }
        $dato_37 = "";
        if (isset($spreadSheetAry[$i][36])) {
            $dato_37  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][36]); }
        $dato_38 = "";
        if (isset($spreadSheetAry[$i][37])) {
            $dato_38  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][37]); }
        $dato_39 = "";
        if (isset($spreadSheetAry[$i][38])) {
            $dato_39  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][38]); }
        $dato_40 = "";
        if (isset($spreadSheetAry[$i][39])) {
            $dato_40  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][39]); }
        $dato_41 = "";
        if (isset($spreadSheetAry[$i][40])) {
            $dato_41  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][40]); }
        $dato_42 = "";
        if (isset($spreadSheetAry[$i][41])) {
            $dato_42  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][41]); }
        $dato_43 = "";
        if (isset($spreadSheetAry[$i][42])) {
            $dato_43  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][42]); }
        $dato_44 = "";
        if (isset($spreadSheetAry[$i][43])) {
            $dato_44  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][43]); }
        $dato_45 = "";
        if (isset($spreadSheetAry[$i][44])) {
            $dato_45  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][44]); }
        $dato_46 = "";
        if (isset($spreadSheetAry[$i][45])) {
            $dato_46  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][45]); }
        $dato_47 = "";
        if (isset($spreadSheetAry[$i][46])) {
            $dato_47  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][46]); }
        $dato_48 = "";
        if (isset($spreadSheetAry[$i][47])) {
            $dato_48  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][47]); }
        $dato_49 = "";
        if (isset($spreadSheetAry[$i][48])) {
            $dato_49  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][48]); }
        $dato_50 = "";
        if (isset($spreadSheetAry[$i][49])) {
            $dato_50  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][49]); }
        $dato_51 = "";
        if (isset($spreadSheetAry[$i][50])) {
            $dato_51  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][50]); }
        $dato_52 = "";
        if (isset($spreadSheetAry[$i][51])) {
            $dato_52  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][51]); }
        $dato_53 = "";
        if (isset($spreadSheetAry[$i][52])) {
            $dato_53  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][52]); }
        $dato_54 = "";
        if (isset($spreadSheetAry[$i][53])) {
            $dato_54  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][53]); }
        $dato_55 = "";
        if (isset($spreadSheetAry[$i][54])) {
            $dato_55  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][54]); }
        $dato_56 = "";
        if (isset($spreadSheetAry[$i][55])) {
            $dato_56  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][55]); }
        $dato_57 = "";
        if (isset($spreadSheetAry[$i][56])) {
            $dato_57  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][56]); }
        $dato_58 = "";
        if (isset($spreadSheetAry[$i][57])) {
            $dato_58  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][57]); }
        $dato_59 = "";
        if (isset($spreadSheetAry[$i][58])) {
            $dato_59  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][58]); }
        $dato_60 = "";
        if (isset($spreadSheetAry[$i][59])) {
            $dato_60  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][59]); }
        $dato_61 = "";
        if (isset($spreadSheetAry[$i][60])) {
            $dato_61  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][60]); }
        $dato_62 = "";
        if (isset($spreadSheetAry[$i][61])) {
            $dato_62  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][61]); }
        $dato_63 = "";
        if (isset($spreadSheetAry[$i][62])) {
            $dato_63  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][62]); }
        $dato_64 = "";
        if (isset($spreadSheetAry[$i][63])) {
            $dato_64  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][63]); }
        $dato_65 = "";
        if (isset($spreadSheetAry[$i][64])) {
            $dato_65  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][64]); }
        $dato_66 = "";
        if (isset($spreadSheetAry[$i][65])) {
            $dato_66  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][65]); }
        $dato_67 = "";
        if (isset($spreadSheetAry[$i][66])) {
            $dato_67  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][66]); }
        $dato_68 = "";
        if (isset($spreadSheetAry[$i][67])) {
            $dato_68  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][67]); }
        $dato_69 = "";
        if (isset($spreadSheetAry[$i][68])) {
            $dato_69  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][68]); }
        $dato_70 = "";
        if (isset($spreadSheetAry[$i][69])) {
            $dato_70  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][69]); }
        $dato_71 = "";
        if (isset($spreadSheetAry[$i][70])) {
            $dato_71  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][70]); }
        $dato_72 = "";
        if (isset($spreadSheetAry[$i][71])) {
            $dato_72  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][71]); }
        $dato_73 = "";
        if (isset($spreadSheetAry[$i][72])) {
            $dato_73  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][72]); }
        $dato_74 = "";
        if (isset($spreadSheetAry[$i][73])) {
            $dato_74  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][73]); }
        $dato_75 = "";
        if (isset($spreadSheetAry[$i][74])) {
            $dato_75  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][74]); }
        $dato_76 = "";
        if (isset($spreadSheetAry[$i][75])) {
            $dato_76  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][75]); }
        $dato_77 = "";
        if (isset($spreadSheetAry[$i][76])) {
            $dato_77  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][76]); }
        $dato_78 = "";
        if (isset($spreadSheetAry[$i][77])) {
            $dato_78  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][77]); }
        $dato_79 = "";
        if (isset($spreadSheetAry[$i][78])) {
            $dato_79  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][78]); }
        $dato_80 = "";
        if (isset($spreadSheetAry[$i][79])) {
            $dato_80  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][79]); }
        $dato_81 = "";
        if (isset($spreadSheetAry[$i][80])) {
            $dato_81  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][80]); }
        $dato_82 = "";
        if (isset($spreadSheetAry[$i][81])) {
            $dato_82  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][81]); }
        $dato_83 = "";
        if (isset($spreadSheetAry[$i][82])) {
            $dato_83  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][82]); }
        $dato_84 = "";
        if (isset($spreadSheetAry[$i][83])) {
            $dato_84  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][83]); }
        $dato_85 = "";
        if (isset($spreadSheetAry[$i][84])) {
            $dato_85  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][84]); }
        $dato_86 = "";
        if (isset($spreadSheetAry[$i][85])) {
            $dato_86  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][85]); }
        $dato_87 = "";
        if (isset($spreadSheetAry[$i][86])) {
            $dato_87  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][86]); }
        $dato_88 = "";
        if (isset($spreadSheetAry[$i][87])) {
            $dato_88  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][87]); }
        $dato_89 = "";
        if (isset($spreadSheetAry[$i][88])) {
            $dato_89  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][88]); }
        $dato_90 = "";
        if (isset($spreadSheetAry[$i][89])) {
            $dato_90  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][89]); }
        $dato_91 = "";
        if (isset($spreadSheetAry[$i][90])) {
            $dato_91  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][90]); }
        $dato_92 = "";
        if (isset($spreadSheetAry[$i][91])) {
            $dato_92  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][91]); }
        $dato_93 = "";
        if (isset($spreadSheetAry[$i][92])) {
            $dato_93  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][92]); }
        $dato_94 = "";
        if (isset($spreadSheetAry[$i][93])) {
            $dato_94  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][93]); }
        $dato_95 = "";
        if (isset($spreadSheetAry[$i][94])) {
            $dato_95  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][94]); }
        $dato_96 = "";
        if (isset($spreadSheetAry[$i][95])) {
            $dato_96  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][95]); }
        $dato_97 = "";
        if (isset($spreadSheetAry[$i][96])) {
            $dato_97  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][96]); }
        $dato_98 = "";
        if (isset($spreadSheetAry[$i][97])) {
            $dato_98  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][97]); }
        $dato_99 = "";
        if (isset($spreadSheetAry[$i][98])) {
            $dato_99  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][98]); }
        $dato_100 = "";
        if (isset($spreadSheetAry[$i][99])) {
            $dato_100  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][99]); }
        $dato_101 = "";
        if (isset($spreadSheetAry[$i][100])) {
            $dato_101  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][100]); }
        $dato_102 = "";
        if (isset($spreadSheetAry[$i][101])) {
            $dato_102  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][101]); }
        $dato_103 = "";
        if (isset($spreadSheetAry[$i][102])) {
            $dato_103  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][102]); }
        $dato_104 = "";
        if (isset($spreadSheetAry[$i][103])) {
            $dato_104  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][103]); }
        $dato_105 = "";
        if (isset($spreadSheetAry[$i][104])) {
            $dato_105  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][104]); }
        $dato_106 = "";
        if (isset($spreadSheetAry[$i][105])) {
            $dato_106  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][105]); }
        $dato_107 = "";
        if (isset($spreadSheetAry[$i][106])) {
            $dato_107  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][106]); }
        $dato_108 = "";
        if (isset($spreadSheetAry[$i][107])) {
            $dato_108  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][107]); }
        $dato_109 = "";
        if (isset($spreadSheetAry[$i][108])) {
            $dato_109  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][108]); }
        $dato_110 = "";
        if (isset($spreadSheetAry[$i][109])) {
            $dato_110  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][109]); }
        $dato_111 = "";
        if (isset($spreadSheetAry[$i][110])) {
            $dato_111  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][110]); }
        $dato_112 = "";
        if (isset($spreadSheetAry[$i][111])) {
            $dato_112  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][111]); }
        $dato_113 = "";
        if (isset($spreadSheetAry[$i][112])) {
            $dato_113  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][112]); }
        $dato_114 = "";
        if (isset($spreadSheetAry[$i][113])) {
            $dato_114  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][113]); }
        $dato_115 = "";
        if (isset($spreadSheetAry[$i][114])) {
            $dato_115  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][114]); }
        $dato_116 = "";
        if (isset($spreadSheetAry[$i][115])) {
            $dato_116  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][115]); }
        $dato_117 = "";
        if (isset($spreadSheetAry[$i][116])) {
            $dato_117  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][116]); }
        $dato_118 = "";
        if (isset($spreadSheetAry[$i][117])) {
            $dato_118  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][117]); }
        $dato_119 = "";
        if (isset($spreadSheetAry[$i][118])) {
            $dato_119  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][118]); }
        $dato_120 = "";
        if (isset($spreadSheetAry[$i][119])) {
            $dato_120  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][119]); }
        $dato_121 = "";
        if (isset($spreadSheetAry[$i][120])) {
            $dato_121  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][120]); }
        $dato_122 = "";
        if (isset($spreadSheetAry[$i][121])) {
            $dato_122  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][121]); }
        $dato_123 = "";
        if (isset($spreadSheetAry[$i][122])) {
            $dato_123  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][122]); }
        $dato_124 = "";
        if (isset($spreadSheetAry[$i][123])) {
            $dato_124  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][123]); }
        $dato_125 = "";
        if (isset($spreadSheetAry[$i][124])) {
            $dato_125  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][124]); }
        $dato_126 = "";
        if (isset($spreadSheetAry[$i][125])) {
            $dato_126  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][125]); }
        $dato_127 = "";
        if (isset($spreadSheetAry[$i][126])) {
            $dato_127  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][126]); }
        $dato_128 = "";
        if (isset($spreadSheetAry[$i][127])) {
            $dato_128  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][127]); }
        $dato_129 = "";
        if (isset($spreadSheetAry[$i][128])) {
            $dato_129  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][128]); }
        $dato_130 = "";
        if (isset($spreadSheetAry[$i][129])) {
            $dato_130  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][129]); }
        $dato_131 = "";
        if (isset($spreadSheetAry[$i][130])) {
            $dato_131  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][130]); }
        $dato_132 = "";
        if (isset($spreadSheetAry[$i][131])) {
            $dato_132  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][131]); }
        $dato_133 = "";
        if (isset($spreadSheetAry[$i][132])) {
            $dato_133  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][132]); }
        $dato_134 = "";
        if (isset($spreadSheetAry[$i][133])) {
            $dato_134  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][133]); }
        $dato_135 = "";
        if (isset($spreadSheetAry[$i][134])) {
            $dato_135  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][134]); }
        $dato_136 = "";
        if (isset($spreadSheetAry[$i][135])) {
            $dato_136  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][135]); }
        $dato_137 = "";
        if (isset($spreadSheetAry[$i][136])) {
            $dato_137  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][136]); }
        $dato_138 = "";
        if (isset($spreadSheetAry[$i][137])) {
            $dato_138  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][137]); }
        $dato_139 = "";
        if (isset($spreadSheetAry[$i][138])) {
            $dato_139  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][138]); }
        $dato_140 = "";
        if (isset($spreadSheetAry[$i][139])) {
            $dato_140  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][139]); }
        $dato_141 = "";
        if (isset($spreadSheetAry[$i][140])) {
            $dato_141  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][140]); }
        $dato_142 = "";
        if (isset($spreadSheetAry[$i][141])) {
            $dato_142  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][141]); }
        $dato_143 = "";
        if (isset($spreadSheetAry[$i][142])) {
            $dato_143  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][142]); }
        $dato_144 = "";
        if (isset($spreadSheetAry[$i][143])) {
            $dato_144  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][143]); }            
      
      if (
        ! empty($dato_01) || ! empty($dato_02) || ! empty($dato_03) || ! empty($dato_04) || ! empty($dato_05) || ! empty($dato_06) || ! empty($dato_07) || ! empty($dato_08) || ! empty($dato_09) || ! empty($dato_10) || ! empty($dato_11) || ! empty($dato_12) || ! empty($dato_13) || ! empty($dato_14) || ! empty($dato_15) || ! empty($dato_16) || ! empty($dato_17) || ! empty($dato_18) || ! empty($dato_19) || ! empty($dato_20) || ! empty($dato_21) || ! empty($dato_22) || ! empty($dato_23) || ! empty($dato_24) || ! empty($dato_25) || ! empty($dato_26) || ! empty($dato_27) || ! empty($dato_28) || ! empty($dato_29) || ! empty($dato_30) || ! empty($dato_31) || ! empty($dato_32) || ! empty($dato_33) || ! empty($dato_34) || ! empty($dato_35) || ! empty($dato_36) || ! empty($dato_37) || ! empty($dato_38) || ! empty($dato_39) || ! empty($dato_40) || ! empty($dato_41) || ! empty($dato_42) || ! empty($dato_43) || ! empty($dato_44) || ! empty($dato_45) || ! empty($dato_46) || ! empty($dato_47) || ! empty($dato_48) || ! empty($dato_49) || ! empty($dato_50) || ! empty($dato_51) || ! empty($dato_52) || ! empty($dato_53) || ! empty($dato_54) || ! empty($dato_55) || ! empty($dato_56) || ! empty($dato_57) || ! empty($dato_58) || ! empty($dato_59) || ! empty($dato_60) || ! empty($dato_61) || ! empty($dato_62) || ! empty($dato_63) || ! empty($dato_64) || ! empty($dato_65) || ! empty($dato_66) || ! empty($dato_67) || ! empty($dato_68) || ! empty($dato_69) || ! empty($dato_70) || ! empty($dato_71) || ! empty($dato_72) || ! empty($dato_73) || ! empty($dato_74) || ! empty($dato_75) || ! empty($dato_76) || ! empty($dato_77) || ! empty($dato_78) || ! empty($dato_79) || ! empty($dato_80) || ! empty($dato_81) || ! empty($dato_82) || ! empty($dato_83) || ! empty($dato_84) || ! empty($dato_85) || ! empty($dato_86) || ! empty($dato_87) || ! empty($dato_88) || ! empty($dato_89) || ! empty($dato_90) || ! empty($dato_91) || ! empty($dato_92) || ! empty($dato_93) || ! empty($dato_94) || ! empty($dato_95) || ! empty($dato_96) || ! empty($dato_97) || ! empty($dato_98) || ! empty($dato_99) || ! empty($dato_100) || ! empty($dato_101) || ! empty($dato_102) || ! empty($dato_103) || ! empty($dato_104) || ! empty($dato_105) || ! empty($dato_106) || ! empty($dato_107) || ! empty($dato_108) || ! empty($dato_109) || ! empty($dato_110) || ! empty($dato_111) || ! empty($dato_112) || ! empty($dato_113) || ! empty($dato_114) || ! empty($dato_115) || ! empty($dato_116) || ! empty($dato_117) || ! empty($dato_118) || ! empty($dato_119) || ! empty($dato_120) || ! empty($dato_121) || ! empty($dato_122) || ! empty($dato_123) || ! empty($dato_124) || ! empty($dato_125) || ! empty($dato_126) || ! empty($dato_127) || ! empty($dato_128) || ! empty($dato_129) || ! empty($dato_130) || ! empty($dato_131) || ! empty($dato_132) || ! empty($dato_133) || ! empty($dato_134) || ! empty($dato_135) || ! empty($dato_136) || ! empty($dato_137) || ! empty($dato_138) || ! empty($dato_139) || ! empty($dato_140) || ! empty($dato_141) || ! empty($dato_142) || ! empty($dato_143) || ! empty($dato_144)) {
        $query = "insert into stage_00(dato_01, dato_02, dato_03, dato_04, dato_05, dato_06, dato_07, dato_08, dato_09, dato_10, dato_11, dato_12, dato_13, dato_14, dato_15, dato_16, dato_17, dato_18, dato_19, dato_20, dato_21, dato_22, dato_23, dato_24, dato_25, dato_26, dato_27, dato_28, dato_29, dato_30, dato_31, dato_32, dato_33, dato_34, dato_35, dato_36, dato_37, dato_38, dato_39, dato_40, dato_41, dato_42, dato_43, dato_44, dato_45, dato_46, dato_47, dato_48, dato_49, dato_50, dato_51, dato_52, dato_53, dato_54, dato_55, dato_56, dato_57, dato_58, dato_59, dato_60, dato_61, dato_62, dato_63, dato_64, dato_65, dato_66, dato_67, dato_68, dato_69, dato_70, dato_71, dato_72, dato_73, dato_74, dato_75, dato_76, dato_77, dato_78, dato_79, dato_80, dato_81, dato_82, dato_83, dato_84, dato_85, dato_86, dato_87, dato_88, dato_89, dato_90, dato_91, dato_92, dato_93, dato_94, dato_95, dato_96, dato_97, dato_98, dato_99, dato_100, dato_101, dato_102, dato_103, dato_104, dato_105, dato_106, dato_107, dato_108, dato_109, dato_110, dato_111, dato_112, dato_113, dato_114, dato_115, dato_116, dato_117, dato_118, dato_119, dato_120, dato_121, dato_122, dato_123, dato_124, dato_125, dato_126, dato_127, dato_128, dato_129, dato_130, dato_131, dato_132, dato_133, dato_134, dato_135, dato_136, dato_137, dato_138, dato_139, dato_140, dato_141, dato_142, dato_143, dato_144, dato_145) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $paramType = "sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss";
        $paramArray = array(
          $dato_01, $dato_02, $dato_03, $dato_04, $dato_05, $dato_06, $dato_07, $dato_08, $dato_09, $dato_10, $dato_11, $dato_12, $dato_13, $dato_14, $dato_15, $dato_16, $dato_17, $dato_18, $dato_19, $dato_20, $dato_21, $dato_22, $dato_23, $dato_24, $dato_25, $dato_26, $dato_27, $dato_28, $dato_29, $dato_30, $dato_31, $dato_32, $dato_33, $dato_34, $dato_35, $dato_36, $dato_37, $dato_38, $dato_39, $dato_40, $dato_41, $dato_42, $dato_43, $dato_44, $dato_45, $dato_46, $dato_47, $dato_48, $dato_49, $dato_50, $dato_51, $dato_52, $dato_53, $dato_54, $dato_55, $dato_56, $dato_57, $dato_58, $dato_59, $dato_60, $dato_61, $dato_62, $dato_63, $dato_64, $dato_65, $dato_66, $dato_67, $dato_68, $dato_69, $dato_70, $dato_71, $dato_72, $dato_73, $dato_74, $dato_75, $dato_76, $dato_77, $dato_78, $dato_79, $dato_80, $dato_81, $dato_82, $dato_83, $dato_84, $dato_85, $dato_86, $dato_87, $dato_88, $dato_89, $dato_90, $dato_91, $dato_92, $dato_93, $dato_94, $dato_95, $dato_96, $dato_97, $dato_98, $dato_99, $dato_100, $dato_101, $dato_102, $dato_103, $dato_104, $dato_105, $dato_106, $dato_107, $dato_108, $dato_109, $dato_110, $dato_111, $dato_112, $dato_113, $dato_114, $dato_115, $dato_116, $dato_117, $dato_118, $dato_119, $dato_120, $dato_121, $dato_122, $dato_123, $dato_124, $dato_125, $dato_126, $dato_127, $dato_128, $dato_129, $dato_130, $dato_131, $dato_132, $dato_133, $dato_134, $dato_135, $dato_136, $dato_137, $dato_138, $dato_139, $dato_140, $dato_141, $dato_142, $dato_143, $dato_144, $nombreUsuario
        );
        $insertId = $db->insert($query, $paramType, $paramArray);
        $conta++;

        if (! empty($insertId)) {        
          $type = "success";
          $message = "Datos importados de Excel a la Base de Datos: ".$conta." registros.";
        } else {
          $type = "error";
          $message = "Problemas al importar los datos de Excel. Intente de nuevo";
        }
      }
    }

  } else {
    $type = "error";
    $message = "El tipo de archivo seleccionado es invalido. Solo puede subir archivos de Excel.";
  }
}
?>

<div class="col-md-12">

  <div class="card text-dark bg-light">
    <div class="card-header">
      Datos de los Beneficiarios
    </div>
    <div class="card-body">
      <form method="POST" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
        <div class="form-group">
          <label for="txtImagen">Seleccione el archivo Excel a cargar:</label>
          <br>
          <br>
          <input type="file" class="form-control" name="file" id="file" accept=".xls,.xlsx"> 
        </div>
        <br>
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="submit" id="submit" name="import" value="agregar" class="btn btn-success btn-lg">Importar registros</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class=card-text>
      <div class="<?php if(!empty($type)) { echo $type . " alert alert-success role=alert"; } ?>"><?php if(!empty($message)) { echo $message; } ?>
      </div>
  </div>
</div>


<?php include("administrador/template/pie.php"); ?>