<?php
function format_decimal($value){
    return round($value, 8);
}

//fungsi utama
function proses_DT($db_object, $parent, $kasus_cabang1, $kasus_cabang2, $kasus_cabang3) {
    echo "cabang 1<br>";
    pembentukan_tree($db_object, $parent, $kasus_cabang1);
    echo "cabang 2<br>";
    pembentukan_tree($db_object, $parent, $kasus_cabang2);
    echo "cabang 3<br>";
    pembentukan_tree($db_object, $parent, $kasus_cabang3);
}

//fungsi proses dalam suatu kasus data
function pembentukan_tree($db_object, $N_parent, $kasus) {
    //mengisi kondisi
    if ($N_parent != '') {
        $kondisi = $N_parent . " AND " . $kasus;
    } else {
        $kondisi = $kasus;
    }
    echo $kondisi . "<br>";
    //cek data heterogen / homogen???
    $cek = cek_heterohomogen($db_object, 'hasil', $kondisi);
    if ($cek == 'homogen') {
        echo "<br>LEAF ||";
        $sql_keputusan = $db_object->db_query("SELECT DISTINCT(hasil) FROM "
                . "tb_training2 WHERE $kondisi");
        $row_keputusan = $db_object->db_fetch_array($sql_keputusan);
        $keputusan = $row_keputusan['0'];
        //insert atau lakukan pemangkasan cabang
        pangkas($db_object, $N_parent, $kasus, $keputusan);
    }//jika data masih heterogen
    else if ($cek == 'heterogen') {
        //jika kondisi tidak kosong kondisi_kelas_asli=tambah and
        $kondisi_kelas_asli = '';
        if ($kondisi != '') {
            $kondisi_kelas_asli = $kondisi . " AND ";
        }
        $jml_ipa = jumlah_data($db_object, "$kondisi_kelas_asli hasil='IPA'");
        $jml_ips = jumlah_data($db_object, "$kondisi_kelas_asli hasil='IPS'");
        
        $jml_total = $jml_ipa + $jml_ips;
        echo "Jumlah Data = " . $jml_total . "<br>";
        echo "Jumlah IPA = " . $jml_ipa . "<br>";
        echo "Jumlah IPS = " . $jml_ips . "<br>";

        //hitung entropy semua
        $entropy_all = hitung_entropy($jml_ipa, $jml_ips);
        echo "Entropy All = " . $entropy_all . "<br>";

        echo "<table class='table table-bordered table-striped  table-hover'>";
        echo "<tr><th>Nilai Atribut</th> <th>Jumlah Data</th> <th>Jumlah IPA</th> <th>Jumlah IPS</th> "
        . "<th>Entropy</th> <th>Gain</th><tr>";

        $db_object->db_query("TRUNCATE gain");
        //hitung gain atribut KATEGORIKAL
        hitung_gain($db_object, $kondisi, "Minat", $entropy_all, "minat='IPA'", "minat='IPS'", "", "", "");

        //Nilai Matematika
        hitung_gain($db_object, $kondisi, "Nilai Matematika", $entropy_all, "mtk_grade='A'", "mtk_grade='B'", "mtk_grade='C'", "", "");
        
        //Nilai IPA
        hitung_gain($db_object, $kondisi, "Nilai IPA", $entropy_all, "ipa_grade='A'", "ipa_grade='B'", "ipa_grade='C'", "", "");

        //Nilai IPS
        hitung_gain($db_object, $kondisi, "Nilai IPS", $entropy_all, "ips_grade='A'", "ips_grade='B'", "ips_grade='C'", "", "");

        //Nilai Tes
        hitung_gain($db_object, $kondisi, "Nilai Tes", $entropy_all, "nilai_tes='A'", "nilai_tes='B'", "nilai_tes='C'", "", "");
        

        echo "</table>";
        //ambil nilai gain terBesar
        $sql_max = $db_object->db_query("SELECT MAX(gain) FROM gain");
        $row_max = $db_object->db_fetch_array($sql_max);
        $max_gain = $row_max[0];
        $sql = $db_object->db_query("SELECT * FROM gain WHERE gain=$max_gain");
        $row = $db_object->db_fetch_array($sql);
        $atribut = $row[2];
        echo "Atribut terpilih = " . $atribut . ", dengan nilai gain = " . $max_gain . "<br>";
        echo "<br>================================<br>";

        //jika max gain = 0 perhitungan dihentikan dan mengambil keputusan
        if ($max_gain == 0) {
            echo "<br>LEAF ";
            $NIPA = $kondisi . " AND hasil='IPA'";
            $NIPS = $kondisi . " AND hasil='IPS'";

            $jumlahIPA = jumlah_data($db_object, "$NIPA");
            $jumlahIPS = jumlah_data($db_object, "$NIPS");

            if($jumlahIPA >= $jumlahIPS) {
                $keputusan = 'IPA';
            }
            else {
                $keputusan = 'IPS';
            }
            //insert atau lakukan pemangkasan cabang
            pangkas($db_object, $N_parent, $kasus, $keputusan);
        }
        //jika max_gain >0 lanjut..
        else {
            
            //Atribut Minat terpilih
            if ($atribut == "Minat") {
                proses_DT($db_object, $kondisi, "(minat='IPA')", "(minat='IPS')","");
            }

            //Nilai Matematika Terpilih 
            if ($atribut == "Nilai Matematika") {
                proses_DT($db_object, $kondisi, "(mtk_grade='A')", "(mtk_grade='B')", "(mtk_grade='C')");
            }

            //Nilai IPA Terpilih
            if ($atribut == "Nilai IPA") {
                proses_DT($db_object, $kondisi, "(ipa_grade='A')", "(ipa_grade='B')", "(ipa_grade='C')");
            }
            //Nilai IPS Terpilih
            if ($atribut == "Nilai IPS") {
                proses_DT($db_object, $kondisi, "(ips_grade='A')", "(ips_grade='B')", "(ips_grade='C')");
            }
            //Nilai Tes Terpilih
            if ($atribut == "Nilai Tes") {
                proses_DT($db_object, $kondisi, "(nilai_tes='A')", "(nilai_tes='B')", "(nilai_tes='C')");
            }

            
        }
    }
}

//==============================================================================
//fungsi cek nilai atribut
function cek_nilaiAtribut($db_object, $field , $kondisi){
    //sql disticnt		
    $hasil = array();
    if($kondisi==''){
            $sql = $db_object->db_query("SELECT DISTINCT($field) FROM tb_training2");					
    }else{
            $sql = $db_object->db_query("SELECT DISTINCT($field) FROM tb_training2 WHERE $kondisi");					
    }
    $a=0;
    while($row = $db_object->db_fetch_array($sql)){
            $hasil[$a] = $row['0'];
            $a++;
    }	
    return $hasil;
}

//fungsi cek heterogen data
function cek_heterohomogen($db_object, $field, $kondisi) {
    //sql disticnt
    if ($kondisi == '') {
        $sql = $db_object->db_query("SELECT DISTINCT($field) FROM tb_training2");
    } else {
        $sql = $db_object->db_query("SELECT DISTINCT($field) FROM tb_training2 WHERE $kondisi");
    }
    //jika jumlah data 1 maka homogen
    if ($db_object->db_num_rows($sql) == 1) {
        $nilai = "homogen";
    } else {
        $nilai = "heterogen";
    }
    return $nilai;
}

//fungsi menghitung jumlah data
function jumlah_data($db_object, $kondisi) {
    //sql
    if ($kondisi == '') {
        $sql = "SELECT COUNT(*) FROM tb_training2 $kondisi";
    } else {
        $sql = "SELECT COUNT(*) FROM tb_training2 WHERE $kondisi";
    }

    $query = $db_object->db_query($sql);
    $row = $db_object->db_fetch_array($query);
    $jml = $row['0'];
    return $jml;
}

//fungsi pemangkasan cabang
function pangkas($db_object, $PARENT, $KASUS, $LEAF) {
        $sql_in = "INSERT INTO t_keputusan "
                . "(parent,akar,keputusan)"
                . " VALUES (\"$PARENT\" , \"$KASUS\" , \"$LEAF\")";
        $db_object->db_query($sql_in);
    echo "Keputusan = " . $LEAF . "<br>================================<br>";
}

//fungsi menghitung gain
function hitung_gain($db_object, $kasus, $atribut, $ent_all, $kondisi1, $kondisi2, $kondisi3, $kondisi4) {
    $data_kasus = '';
    if ($kasus != '') {
        $data_kasus = $kasus . " AND ";
    }

    //untuk atribut 2 nilai atribut	
    if ($kondisi3 == '') {
        $j_sanguin1 = jumlah_data($db_object, "$data_kasus hasil='IPA' AND $kondisi1");
        $j_koleris1 = jumlah_data($db_object, "$data_kasus hasil='IPS' AND $kondisi1");

        $jml1 = $j_sanguin1 + $j_koleris1;
        
        $j_sanguin2 = jumlah_data($db_object, "$data_kasus hasil='IPA' AND $kondisi2");
        $j_koleris2 = jumlah_data($db_object, "$data_kasus hasil='IPS' AND $kondisi2");
        
        $jml2 = $j_sanguin2 + $j_koleris2;
        //hitung entropy masing-masing kondisi
        $jml_total = $jml1 + $jml2;
        $ent1 = hitung_entropy($j_sanguin1, $j_koleris1);
        $ent2 = hitung_entropy($j_sanguin2, $j_koleris2);

        if($jml_total == null){
            return 0;
        }

        $gain = $ent_all - ((($jml1 / $jml_total) * $ent1) + (($jml2 / $jml_total) * $ent2));
        //desimal 3 angka dibelakang koma
        $gain = format_decimal($gain);

        echo "<tr>";
        echo "<td>" . $kondisi1 . "</td>";
        echo "<td>" . $jml1 . "</td>";
        echo "<td>" . $j_sanguin1 . "</td>";
        echo "<td>" . $j_koleris1 . "</td>";
        echo "<td>" . $ent1 . "</td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $kondisi2 . "</td>";
        echo "<td>" . $jml2 . "</td>";
        echo "<td>" . $j_sanguin2 . "</td>";
        echo "<td>" . $j_koleris2 . "</td>";
        echo "<td>" . $ent2 . "</td>";
        echo "<td>" . $gain . "</td>";
        echo "</tr>";

        echo "<tr><td colspan='8'></td></tr>";
    }
     //untuk atribut 3 nilai atribut
     else if($kondisi4==''){
     	$j_sanguin1 = jumlah_data($db_object, "$data_kasus hasil='IPA' AND $kondisi1");
     	$j_koleris1 = jumlah_data($db_object, "$data_kasus hasil='IPS' AND $kondisi1");

     	$jml1 = $j_sanguin1 + $j_koleris1;
        
     	$j_sanguin2 = jumlah_data($db_object, "$data_kasus hasil='IPA' AND $kondisi2");
     	$j_koleris2 = jumlah_data($db_object, "$data_kasus hasil='IPS' AND $kondisi2");

     	$jml2 = $j_sanguin2 + $j_koleris2;
        
     	$j_sanguin3 = jumlah_data($db_object, "$data_kasus hasil='IPA' AND $kondisi3");
     	$j_koleris3 = jumlah_data($db_object, "$data_kasus hasil='IPS' AND $kondisi3");

     	$jml3 = $j_sanguin3 + $j_koleris3;
        
     	//hitung entropy masing-masing kondisi
     	$jml_total = $jml1 + $jml2 + $jml3;
     	$ent1 = hitung_entropy($j_sanguin1 , $j_koleris1);
     	$ent2 = hitung_entropy($j_sanguin2 , $j_koleris2);
     	$ent3 = hitung_entropy($j_sanguin3 , $j_koleris3);

        if($jml_total == null){
            return 0;
        }

     	$gain = $ent_all - ((($jml1/$jml_total)*$ent1) + (($jml2/$jml_total)*$ent2) 
     				+ (($jml3/$jml_total)*$ent3));							
     	//desimal 3 angka dibelakang koma
     	$gain = format_decimal($gain);				
     	echo "<tr>";
     	echo "<td>".$kondisi1."</td>";
     	echo "<td>".$jml1."</td>";
     	echo "<td>".$j_sanguin1."</td>";
     	echo "<td>".$j_koleris1."</td>";
     	echo "<td>".$ent1."</td>";
     	echo "<td>&nbsp;</td>";
     	echo "</tr>";
     	echo "<tr>";
     	echo "<td>".$kondisi2."</td>";
     	echo "<td>".$jml2."</td>";
     	echo "<td>".$j_sanguin2."</td>";
     	echo "<td>".$j_koleris2."</td>";
     	echo "<td>".$ent2."</td>";
     	echo "<td>&nbsp;</td>";
     	echo "</tr>";
     	echo "<tr>";
     	echo "<td>".$kondisi3."</td>";
     	echo "<td>".$jml3."</td>";
     	echo "<td>".$j_sanguin3."</td>";
     	echo "<td>".$j_koleris3."</td>";
     	echo "<td>".$ent3."</td>";
     	echo "<td>".$gain."</td>";
     	echo "</tr>";
     	echo "<tr><td colspan='8'></td></tr>";
     }
   		
    $db_object->db_query("INSERT INTO gain VALUES ('','1','$atribut','$gain')");
}

//fungsi menghitung entropy
function hitung_entropy($nilai1, $nilai2) {
    $total = $nilai1 + $nilai2;

    if($total == 0){
        return 0;
    }

    $atribut1 = (-($nilai1 / $total) * (log(($nilai1 / $total), 2)));
    $atribut2 = (-($nilai2 / $total) * (log(($nilai2 / $total), 2)));
    
    $atribut1 = is_nan($atribut1)?0:$atribut1;
    $atribut2 = is_nan($atribut2)?0:$atribut2;
    
        $entropy = $atribut1 + 
                    $atribut2;
//    }
    //desimal 3 angka dibelakang koma
    $entropy = format_decimal($entropy);
    return $entropy;
}

//fungsi hitung rasio
function hitung_rasio($db_object, $kasus , $atribut , $gain , $nilai1 , $nilai2 , $nilai3 , $nilai4 , $nilai5){				
    $data_kasus = '';
    if($kasus!=''){
        $data_kasus = $kasus." AND ";
    }
    //menentukan jumlah nilai
    $jmlNilai=5;
    //jika nilai 5 kosong maka nilai atribut-nya 4
    if($nilai5==''){
        $jmlNilai=4;
    }
    //jika nilai 4 kosong maka nilai atribut-nya 3
    if($nilai4==''){
        $jmlNilai=3;
    }
    $db_object->db_query("TRUNCATE rasio_gain");		
    if($jmlNilai==3){
        $opsi11 = jumlah_data($db_object, "$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3')");
        $opsi12 = jumlah_data($db_object, "$data_kasus $atribut='$nilai1'");
        $tot_opsi1=$opsi11+$opsi12;
        $opsi21 = jumlah_data($db_object, "$data_kasus ($atribut='$nilai3' OR $atribut='$nilai1')");
        $opsi22 = jumlah_data($db_object, "$data_kasus $atribut='$nilai2'");
        $tot_opsi2=$opsi21+$opsi22;
        $opsi31 = jumlah_data($db_object, "$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2')");
        $opsi32 = jumlah_data($db_object, "$data_kasus $atribut='$nilai3'");
        $tot_opsi3=$opsi31+$opsi32;			
        //hitung split info
        $opsi1 = (-($opsi11/$tot_opsi1)*(log(($opsi11/$tot_opsi1),2))) + (-($opsi12/$tot_opsi1)*(log(($opsi12/$tot_opsi1),2)));
        $opsi2 = (-($opsi21/$tot_opsi2)*(log(($opsi21/$tot_opsi2),2))) + (-($opsi22/$tot_opsi2)*(log(($opsi22/$tot_opsi2),2)));
        $opsi3 = (-($opsi31/$tot_opsi3)*(log(($opsi31/$tot_opsi3),2))) + (-($opsi32/$tot_opsi3)*(log(($opsi32/$tot_opsi3),2)));
        //desimal 3 angka dibelakang koma
        $opsi1 = format_decimal($opsi1);
        $opsi2 = format_decimal($opsi2);
        $opsi3 = format_decimal($opsi3);										
        //hitung rasio
        $rasio1 = $gain/$opsi1;
        $rasio2 = $gain/$opsi2;
        $rasio3 = $gain/$opsi3;
        //desimal 3 angka dibelakang koma
        $rasio1 = format_decimal($rasio1);
        $rasio2 = format_decimal($rasio2);
        $rasio3 = format_decimal($rasio3);
            //cetak
            echo "Opsi 1 : <br>jumlah ".$nilai2."/".$nilai3." = ".$opsi11.
                    "<br>jumlah ".$nilai1." = ".$opsi12.
                    "<br>Split = ".$opsi1.
                    "<br>Rasio = ".$rasio1."<br>";
            echo "Opsi 2 : <br>jumlah ".$nilai3."/".$nilai1." = ".$opsi21.
                    "<br>jumlah ".$nilai2." = ".$opsi22.
                    "<br>Split = ".$opsi2.
                    "<br>Rasio = ".$rasio2."<br>";
            echo "Opsi 3 : <br>jumlah ".$nilai1."/".$nilai2." = ".$opsi31.
                    "<br>jumlah ".$nilai3." = ".$opsi32.
                    "<br>Split = ".$opsi3.
                    "<br>Rasio = ".$rasio3."<br>";

            //insert 
            $db_object->db_query("INSERT INTO rasio_gain VALUES 
                                    ('' , 'opsi1' , '$nilai1' , '$nilai2 , $nilai3' , '$rasio1'),
                                    ('' , 'opsi2' , '$nilai2' , '$nilai3 , $nilai1' , '$rasio2'),
                                    ('' , 'opsi3' , '$nilai3' , '$nilai1 , $nilai2' , '$rasio3')");
    }
    
    $sql_max = $db_object->db_query("SELECT MAX(rasio_gain) FROM rasio_gain");
    $row_max = $db_object->db_fetch_array($sql_max);	
    $max_rasio = $row_max['0'];
    $sql = $db_object->db_query("SELECT * FROM rasio_gain WHERE rasio_gain=$max_rasio");
    $row = $db_object->db_fetch_array($sql);	
    $opsiMax = array();
    $opsiMax[0] = $row[2];
    $opsiMax[1] = $row[3];		
    echo "<br>=========================<br>";
    return $opsiMax;		
}


function klasifikasi($db_object, $n_minat, $n_ipa, $n_mtk, $n_ips, $n_tes) {

    $sql = $db_object->db_query("SELECT * FROM t_keputusan");
    $keputusan = $id_rule_keputusan = "";
    while ($row = $db_object->db_fetch_array($sql)) {
        //menggabungkan parent dan akar dengan kata AND
        if ($row['parent'] != '') {
            $rule = $row['parent'] . " AND " . $row['akar'];
        } else {
            $rule = $row['akar'];
        }
        //mengubah parameter
        $rule = str_replace("<=", " k ", $rule);
        $rule = str_replace("=", " s ", $rule);
        $rule = str_replace(">", " l ", $rule);
        //mengganti nilai
        $rule = str_replace("minat", "'$n_minat'", $rule);
        $rule = str_replace("ipa_grade", "'$n_ipa'", $rule);
        $rule = str_replace("mtk_grade", "$n_mtk", $rule);
        $rule = str_replace("ips_grade", "$n_ips", $rule);
        $rule = str_replace("nilai_tes", "$n_tes", $rule);
        //menghilangkan '
        $rule = str_replace("'", "", $rule);
        //explode and
        $explodeAND = explode(" AND ", $rule);
        $jmlAND = count($explodeAND);
        //menghilangkan ()
        $explodeAND = str_replace("(", "", $explodeAND);
        $explodeAND = str_replace(")", "", $explodeAND);
        //deklarasi bol
        $bolAND=array();
        $n=0;
        while($n<$jmlAND){
            //explode or
            $explodeOR = explode(" OR ",$explodeAND[$n]);
            $jmlOR = count($explodeOR);	
            //deklarasi bol
            $bol=array();
            $a=0;
            while($a<$jmlOR){				
                //pecah  dengan spasi
                $exrule2 = explode(" ",$explodeOR[$a]);	
                if (count($exrule2) > 1) {
                    if ($exrule2[1] == 's') {
                        //pecah  dengan s
                        $explodeRule = explode(" s ",$explodeOR[$a]);
                        //nilai true false						
                        if($explodeRule[0]==$explodeRule[1]){
                            $bol[$a]="Benar";
                        }else if($explodeRule[0]!=$explodeRule[1]){
                            $bol[$a]="Salah";
                        }
                    } else if($exrule2[1] == 'k') {
                        //pecah  dengan k
                        $explodeRule = explode(" k ",$explodeOR[$a]);
                        //nilai true false
                        if($explodeRule[0]<=$explodeRule[1]){
                            $bol[$a]="Benar";
                        } else {
                            $bol[$a]="Salah";
                        }
                    } else if($exrule2[1] == 'l') {
                        //pecah dengan s
                        $explodeRule = explode(" l ",$explodeOR[$a]);
                        //nilai true false
                        if($explodeRule[0]>$explodeRule[1]){
                            $bol[$a]="Benar";
                        } else {
                            $bol[$a]="Salah";
                        }
                    } else {
                        // Invalid rule format
                        $bol[$a]="Salah";
                    }
                } else {
                    // Invalid rule format
                    $bol[$a]="Salah";
                }
                $a++;
            }
            //isi false
            $bolAND[$n]="Salah";
            $b=0;			
            while($b<$jmlOR){
                //jika $bol[$b] benar bolAND benar
                if($bol[$b]=="Benar"){
                        $bolAND[$n]="Benar";
                }
                $b++;
            }			
            $n++;
        }
        //isi boolrule
        $boolRule="Benar";
        $a=0;
        while($a<$jmlAND){			
                //jika ada yang salah boolrule diganti salah
                if($bolAND[$a]=="Salah"){
                        $boolRule="Salah";
                        break;
                }						
                $a++;
        }		
        if($boolRule=="Benar"){
            $keputusan=$row['keputusan'];
            $id_rule_keputusan=$row['id'];
            break;
        }
        //jika tidak ada rule yang memenuhi kondisi data uji 
        //maka ambil rule paling bawah(ambil konisi yg paling panjang)????....
        if ($keputusan == '') {
            $que = $db_object->db_query("SELECT parent FROM t_keputusan");
            $jml = array();
            $exParent = array();
            $i = 0;
            while ($row_baris = $db_object->db_fetch_array($que)) {
                $exParent = explode(" AND ", $row_baris['parent']);
                $jml[$i] = count($exParent);
                $i++;
            }
            $maxParent = max($jml);
            $sql_query = $db_object->db_query("SELECT * FROM t_keputusan");
            while ($row_bar = $db_object->db_fetch_array($sql_query)) {
                $explP = explode(" AND ", $row_bar['parent']);
                $jmlT = count($explP);
                if ($jmlT == $maxParent) {
                    $keputusan = $row_bar['keputusan'];
                    $id_rule[$i] = $row_bar['id'];
                    $id_rule_keputusan = $row_bar['id'];
                    break;
                }
            }
        }
    }//end loop t_keputusan

    return array('keputusan' => $keputusan, 'id_rule' => $id_rule_keputusan);
}