<html>
<body>
<head>
 
 
 
</head>
<?php
if(isset($_POST['gonder'])){
    $ad     =$_POST['ad'];
    $vize   =$_POST['vize'];
    $yaz    =fopen("kisi.txt","a+");
    fputs($yaz,"$ad\t$vize\n");
    fclose($yaz);
}



if(isset($_POST['Sil'])){
    $ID     =$_POST['ID'];
    $ac     =fopen("kisi.txt","r");
    $gecici =fopen("gecici.txt","w");
    $sayac  =0;
    while(!feof($ac)){
        $deger=fgets($ac);
    if(in_array($sayac,$ID)==FALSE){
        fputs($gecici,$deger);
    }
    $sayac++;
    }
      
    fclose($ac);
    fclose($gecici);
    unlink("kisi.txt");
    rename("gecici.txt","kisi.txt");
}
if(isset($_POST['kaydet'])){
    
    $ad     =$_POST['Ad'];
    $vize =$_POST['vize'];
    $ID     =$_POST['ID'];
    $ac=fopen("kisi.txt","r");
    $gecici=fopen("gecici.txt","w");
    $sayac=0;
    while(!feof($ac)){
        $deger=fgets($ac);
    if($ID==$sayac){
        fputs($gecici,"$ad\t$vize\n");
    }else{
        fputs($gecici,$deger);
    }
    $sayac++;
    }
      
    fclose($ac);
    fclose($gecici);
    unlink("kisi.txt");
    rename("gecici.txt","kisi.txt");
}
foreach($_POST as $veri=>$anahtar){
    if($anahtar=='Duzenle'){
        $ac=fopen("kisi.txt","r");
        $sayac=0;
        while(!feof($ac)){
            $okunan=fgets($ac);
            if($veri==$sayac){
            $parcala=explode("\t",$okunan);
                echo "<form action='' method='POST'>Kimlik No: <input type= 'text'  name='Ad'  value=\"$parcala[0]\"/><br/>
                Ad Soyad: <input type= text  name='vize'  value=\"$parcala[1]\"/><br/>
                <input type= 'hidden'  name='ID'  value='$sayac' />
                <input type= 'submit'  name= 'kaydet'  value='Guncelle' /> 
                <hr>              
                </form>";
            }
            $sayac++;
        }       
      
    fclose($ac);
    }
}
if(file_exists("kisi.txt")){ 
    $ac=fopen("kisi.txt","r");
    echo "<form action='' method= 'POST' ><table border= '2' >";
    echo "<tr><th> Kimlik No</th><th>Ad Soyad</th><th><input type= 'submit'  name= 'Sil'  value= 'Sil'/></th><th>Duzelt</th></tr>";
    $sayac=0;
    while(!feof($ac)){
        $okunan=fgets($ac);
        if(empty($okunan))continue;
        $parcalanan=explode("\t",$okunan);
        echo "<tr>";
        foreach($parcalanan as $veri){
            echo "<td>$veri</td>";
        }
        echo "<td><input type='checkbox'  name= \"ID[]\"  value='$sayac' /></td><td><input type='submit'  name='$sayac'  value='Duzenle' /></td></tr>";
        $sayac++;
    }
    echo "</table></form>";
    fclose($ac);
}
 
?>
 
 
 
 
<form action="" method="POST">
Kimlik No:&nbsp;&nbsp;<input type="text" placeholder="Kimlik No" name="ad"/><br/><br>
Ad Soyad  :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" placeholder="Ad / Soyad" name="vize"/><br/><br>
<input type="submit" name="gonder" value="Kaydet"/>
</form>
</body>
<html>