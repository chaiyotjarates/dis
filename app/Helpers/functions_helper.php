<?php
	function uploadMultiFile($file_name,$i,$path, $prefix_name){

		if(!empty($file_name)){

			$return_file = '';

			$file = explode(".", $_FILES[$file_name]["name"][$i]);
			$is=$i+1;
			$first_name = date("Y-m-d").'_'.$is.'_'.time();

			$newfile = $prefix_name.'_'.$first_name.'.'.end($file);

			$tmp_file = $_FILES[$file_name]["tmp_name"][$i];

			if(move_uploaded_file($tmp_file, $path.$newfile)){

				$return_file = $newfile;

			}

			return $return_file;

		}

	}

	function uploadFile($file_name,$path, $prefix_name){

		if(!empty($file_name)){

			$return_file = '';

			$file = explode(".", $_FILES[$file_name]["name"]);

			$first_name = date("Y-m-d").'_'.time();

			$newfile = $prefix_name.'_'.$first_name.'.'.end($file);

			$tmp_file = $_FILES[$file_name]["tmp_name"];

			if(move_uploaded_file($tmp_file, $path.$newfile)){

				$return_file = $newfile;

			}

			return $return_file;

		}

	}

	function uploadFileCSV($file_name,$path, $prefix_name){

		if(!empty($file_name)){

			$return_file = '';

			$file = explode(".", $_FILES[$file_name]["name"]);

			$newfile = $prefix_name.'.'.end($file);

			$tmp_file = $_FILES[$file_name]["tmp_name"];

			if(move_uploaded_file($tmp_file, $path.$newfile)){

				$return_file = $newfile;

			}

			return $return_file;

		}

	}


	$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
	global $thai_month_arr,$thai_month_arr_short;
	$thai_month_arr=array(
	    "0"=>"",
	    "1"=>"มกราคม",
	    "2"=>"กุมภาพันธ์",
	    "3"=>"มีนาคม",
	    "4"=>"เมษายน",
	    "5"=>"พฤษภาคม",
	    "6"=>"มิถุนายน",
	    "7"=>"กรกฎาคม",
	    "8"=>"สิงหาคม",
	    "9"=>"กันยายน",
	    "10"=>"ตุลาคม",
	    "11"=>"พฤศจิกายน",
	    "12"=>"ธันวาคม"
	);
	$thai_month_arr_short=array(
	    "0"=>"",
	    "1"=>"ม.ค.",
	    "2"=>"ก.พ.",
	    "3"=>"มี.ค.",
	    "4"=>"เม.ย.",
	    "5"=>"พ.ค.",
	    "6"=>"มิ.ย.",
	    "7"=>"ก.ค.",
	    "8"=>"ส.ค.",
	    "9"=>"ก.ย.",
	    "10"=>"ต.ค.",
	    "11"=>"พ.ย.",
	    "12"=>"ธ.ค."
	);
	function thai_date_and_time($time){   // 19 ธันวาคม 2556 เวลา 10:10:43
		$thai_date_return = '';
		global $thai_month_arr;
		$thai_month_arr=array(
	    "0"=>"",
	    "1"=>"มกราคม",
	    "2"=>"กุมภาพันธ์",
	    "3"=>"มีนาคม",
	    "4"=>"เมษายน",
	    "5"=>"พฤษภาคม",
	    "6"=>"มิถุนายน",
	    "7"=>"กรกฎาคม",
	    "8"=>"สิงหาคม",
	    "9"=>"กันยายน",
	    "10"=>"ตุลาคม",
	    "11"=>"พฤศจิกายน",
	    "12"=>"ธันวาคม"
	);
	    $thai_date_return.= date("j",$time);
	    $thai_date_return.=" ".$thai_month_arr[date("n",$time)];
	    $thai_date_return.= " ".(date("Y",$time)+543);
		$thai_date_return.= " เวลา ".date("H:i:s",$time);
	    return $thai_date_return;
	}
	function thai_date_and_time_short($time){   // 19  ธ.ค. 2556 10:10:4
	    $thai_date_return = '';
	    global $thai_day_arr,$thai_month_arr_short;
	    $thai_month_arr_short=array(
	    "0"=>"",
	    "1"=>"ม.ค.",
	    "2"=>"ก.พ.",
	    "3"=>"มี.ค.",
	    "4"=>"เม.ย.",
	    "5"=>"พ.ค.",
	    "6"=>"มิ.ย.",
	    "7"=>"ก.ค.",
	    "8"=>"ส.ค.",
	    "9"=>"ก.ย.",
	    "10"=>"ต.ค.",
	    "11"=>"พ.ย.",
	    "12"=>"ธ.ค."
	);
	    $thai_date_return.=date("j",$time);
	    $thai_date_return.="&nbsp;".$thai_month_arr_short[date("n",$time)];
	    $thai_date_return.= " ".(date("Y",$time)+543);
		$thai_date_return.= " ".date("H:i:s",$time);
	    return $thai_date_return;
	}
	function thai_date_short($time){   // 19  ธ.ค. 2556
		$thai_date_return = '';
	    global $thai_day_arr,$thai_month_arr_short;
	    $thai_date_return.=date("j",$time);
	    $thai_date_return.="&nbsp;&nbsp;".$thai_month_arr_short[date("n",$time)];
	    $thai_date_return.= " ".(date("Y",$time)+543);
	    return $thai_date_return;
	}
	function thai_date_fullmonth($time){   // 19 ธันวาคม 2556
	    global $thai_day_arr,$thai_month_arr;
	    $thai_date_return = '';
	    $thai_date_return.=date("j",$time);
	    $thai_date_return.=" ".$thai_month_arr[date("n",$time)];
	    $thai_date_return.= " ".(date("Y",$time)+543);
	    return $thai_date_return;
	}
	function thai_date_short_number($time){   // 19-12-56
	    global $thai_day_arr,$thai_month_arr;
	    $thai_date_return.=date("d",$time);
	    $thai_date_return.="-".date("m",$time);
	    $thai_date_return.= "-".substr((date("Y",$time)+543),-2);
	    return $thai_date_return;
	}

	function thai_date_slash_number($time){   // 19/12/56
	    global $thai_day_arr,$thai_month_arr;
	    $thai_date_return.=date("d",$time);
	    $thai_date_return.="/".date("m",$time);
	    $thai_date_return.= "/".substr((date("Y",$time)+543),-2);
	    return $thai_date_return;
	}


	function dateConvert($fromdate){
			$sday = substr($fromdate, 0, 2);
			$smonth = substr($fromdate, 3, 2);
			$syear = substr($fromdate, 6, 4);
			$all = $syear."-".$smonth."-".$sday;
			return $all;
	}
	function showDateTextbox($fromdate){
			$sday = trim(substr($fromdate, 0, 2));
			$lenDay = strlen($sday);
			if($lenDay == 1){ $sday = "0".$sday; }
			$smonth = substr($fromdate, 0, -4);
			$smonth = trim(substr($smonth, 2));
			if($smonth == "มกราคม"){
				$smonth = "01";
			}else if($smonth == "กุมภาพันธ์"){
				$smonth = "02";
			}else if($smonth == "มีนาคม"){
				$smonth = "03";
			}else if($smonth == "เมษายน"){
				$smonth = "04";
			}else if($smonth == "พฤษภาคม"){
				$smonth = "05";
			}else if($smonth == "มิถุนายน"){
				$smonth = "06";
			}else if($smonth == "กรกฎาคม"){
				$smonth = "07";
			}else if($smonth == "สิงหาคม"){
				$smonth = "08";
			}else if($smonth == "กันยายน"){
				$smonth = "09";
			}else if($smonth == "ตุลาคม"){
				$smonth = "10";
			}else if($smonth == "พฤศจิกายน"){
				$smonth = "11";
			}else if($smonth == "ธันวาคม"){
				$smonth = "12";
			}else{}
			$syear = substr($fromdate, -4);
			$all = $sday."/".$smonth."/".$syear;
			return $all;
	}


function youtubeID($url){
 	 $res = explode("v=",$url);
	 if(isset($res[1])) {
	 	$res1 = explode('&',$res[1]);
		if(isset($res1[1])){
			$res[1] = $res1[0];
		}
		$res1 = explode('#',$res[1]);
		if(isset($res1[1])){
			$res[1] = $res1[0];
		}
	 }
	 return substr($res[1],0,12);
  	 return false;
 }

function mbmGetFLVDuration($file){
    // read file
  if (file_exists($file)){
    $handle = fopen($file, "r");
    $contents = fread($handle, filesize($file));
    fclose($handle);
    //
    if (strlen($contents) > 3){
      if (substr($contents,0,3) == "FLV"){
        $taglen = hexdec(bin2hex(substr($contents,strlen($contents)-3)));
        if (strlen($contents) > $taglen){
          $duration = hexdec(bin2hex(substr($contents,strlen($contents)-$taglen,3)))  ;
          return $duration;
        }
      }
    }
  }
}

function getDurationSeconds($duration){
    preg_match_all('/[0-9]+[HMS]/',$duration,$matches);
    $duration=0;
    foreach($matches as $match){
        //echo '<br> ========= <br>';       
        //print_r($match);      
        foreach($match as $portion){        
            $unite=substr($portion,strlen($portion)-1);
            switch($unite){
                case 'H':{  
                    $duration +=    substr($portion,0,strlen($portion)-1)*60*60;            
                }break;             
                case 'M':{                  
                    $duration +=substr($portion,0,strlen($portion)-1)*60;           
                }break;             
                case 'S':{                  
                    $duration +=    substr($portion,0,strlen($portion)-1);          
                }break;
            }
        }
    //  echo '<br> duratrion : '.$duration;
    //echo '<br> ========= <br>';
    }
     return $duration;

}


//	$strDate = "2008-08-14 13:42:44";
//	echo "ThaiCreate.Com Time now : ".DateThai($strDate);
	function DateThaiNew($strDate,$full="")
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array(
		"0"=>"",
	    "1"=>"มกราคม",
	    "2"=>"กุมภาพันธ์",
	    "3"=>"มีนาคม",
	    "4"=>"เมษายน",
	    "5"=>"พฤษภาคม",
	    "6"=>"มิถุนายน",
	    "7"=>"กรกฎาคม",
	    "8"=>"สิงหาคม",
	    "9"=>"กันยายน",
	    "10"=>"ตุลาคม",
	    "11"=>"พฤศจิกายน",
	    "12"=>"ธันวาคม"
		);
		$strMonthThai=$strMonthCut[$strMonth];
		if($full){
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
		} else {
		return "$strDay $strMonthThai $strYear";
		}
	}

//	$strDate = "2008-08-14";
//	echo "ThaiCreate.Com Time now : ".DateThai($strDate);
	function ShortDateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strMonthCut = Array(
		"0"=>"",
	    "1"=>"ม.ค.",
	    "2"=>"ก.พ.",
	    "3"=>"มี.ค.",
	    "4"=>"เม.ย.",
	    "5"=>"พ.ค.",
	    "6"=>"มิ.ย.",
	    "7"=>"ก.ค.",
	    "8"=>"ส.ค.",
	    "9"=>"ก.ย.",
	    "10"=>"ต.ค.",
	    "11"=>"พ.ย.",
	    "12"=>"ธ.ค."
		);
		$Month=str_replace('0','',$strMonth);
		$Day=str_replace('0','',$strDay);
		$strMonthThai=$strMonthCut[$Month];
		return "$Day $strMonthThai $strYear";
	}

//เปลี่ยนจาก 2017-02-12 00:00:00 เป็น 12 กุมภาพันธ์ 2560 00:00:00
function FullDateTimeThai($strDate){
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array(
		"0"=>"",
	    "1"=>"มกราคม",
	    "2"=>"กุมภาพันธ์",
	    "3"=>"มีนาคม",
	    "4"=>"เมษายน",
	    "5"=>"พฤษภาคม",
	    "6"=>"มิถุนายน",
	    "7"=>"กรกฎาคม",
	    "8"=>"สิงหาคม",
	    "9"=>"กันยายน",
	    "10"=>"ตุลาคม",
	    "11"=>"พฤศจิกายน",
	    "12"=>"ธันวาคม"
	);
    $strMonthThai = $strMonthCut[$strMonth];
//    return "$strDay $strMonthThai $strYear";
    return "$strDay $strMonthThai $strYear $strHour:$strMinute:$strSeconds";
}

//เปลี่ยนจาก 2017-02-12 เป็น 12 กุมภาพันธ์ 2560
function FullDateThai($strDate){
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array(
		"0"=>"",
	    "1"=>"มกราคม",
	    "2"=>"กุมภาพันธ์",
	    "3"=>"มีนาคม",
	    "4"=>"เมษายน",
	    "5"=>"พฤษภาคม",
	    "6"=>"มิถุนายน",
	    "7"=>"กรกฎาคม",
	    "8"=>"สิงหาคม",
	    "9"=>"กันยายน",
	    "10"=>"ตุลาคม",
	    "11"=>"พฤศจิกายน",
	    "12"=>"ธันวาคม"
	);
    $strMonthThai = $strMonthCut[$strMonth];
//    return "$strDay $strMonthThai $strYear";
    return "$strDay $strMonthThai $strYear";
}

//เปลี่ยนจาก 2017-02-12 เป็น วันที่ 12 เดือน กุมภาพันธ์ พ.ศ. 2560
function FullDateThaiPS($strDate){
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array(
		"0"=>"",
	    "1"=>"มกราคม",
	    "2"=>"กุมภาพันธ์",
	    "3"=>"มีนาคม",
	    "4"=>"เมษายน",
	    "5"=>"พฤษภาคม",
	    "6"=>"มิถุนายน",
	    "7"=>"กรกฎาคม",
	    "8"=>"สิงหาคม",
	    "9"=>"กันยายน",
	    "10"=>"ตุลาคม",
	    "11"=>"พฤศจิกายน",
	    "12"=>"ธันวาคม"
	);
    $strMonthThai = $strMonthCut[$strMonth];
//    return "$strDay $strMonthThai $strYear";
    return "วันที่ $strDay เดือน $strMonthThai พ.ศ. $strYear";
}

//เปลี่ยนจาก 2017-02-12  เป็น 12 ก.พ. 2560
function DateThai($strDate){
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array(
		"0"=>"",
	    "1"=>"ม.ค.",
	    "2"=>"ก.พ.",
	    "3"=>"มี.ค.",
	    "4"=>"เม.ย.",
	    "5"=>"พ.ค.",
	    "6"=>"มิ.ย.",
	    "7"=>"ก.ค.",
	    "8"=>"ส.ค.",
	    "9"=>"ก.ย.",
	    "10"=>"ต.ค.",
	    "11"=>"พ.ย.",
	    "12"=>"ธ.ค."
	);
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
  //  return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
}

function similarity($str1, $str2) {
    $len1 = strlen($str1);
    $len2 = strlen($str2);
   
    $max = max($len1, $len2);
    $similarity = $i = $j = 0;
   
    while (($i < $len1) && isset($str2[$j])) {
        if ($str1[$i] == $str2[$j]) {
            $similarity++;
            $i++;
            $j++;
        } elseif ($len1 < $len2) {
            $len1++;
            $j++;
        } elseif ($len1 > $len2) {
            $i++;
            $len1--;
        } else {
            $i++;
            $j++;
        }
    }

    return round($similarity / $max, 2);
}
//$str1 = '12345678901234567890';
//$str2 = '12345678991234567890';

//echo 'Similarity: ' . (similarity($str1, $str2) * 100) . '%';


//$var_1 = strtoupper("doggy");
//$var_2 = strtoupper("Dog");

//similar_text($var_1, $var_2, $percent); 

//แปรผลการประเมิน
function Item_Result_Sheet($Percent){
	if($Percent > 100.00 ){
		return "<div class='text-danger'>ข้อมูลผิดพลาด</div>";
	} else if($Percent >= 80.00 && $Percent <=100.00){
		return "<div class='text-success'>ดีมาก</div>";
	} else if($Percent >= 70.00 && $Percent <=79.99) {
		return "<div class='text-primary'>ดี</div>";
	} else if($Percent >= 60.00 && $Percent <=69.99) {
		return "<div class='text-info'>ค่อนข้างดี</div>";
	} else if($Percent >= 50.00 && $Percent <=59.99 ) {
		return "<div class='text-warning'>พอใช้</div>";
	} else {
		return "<div class='text-danger'>ปรับปรุง</div>";
	}
}
//แปรผลการประเมิน print
function Item_Result_Sheet_P($Percent){
	if($Percent > 100.00 ){
		return "ข้อมูลผิดพลาด";
	} else if($Percent >= 80.00 && $Percent <=100.00){
		return "ดีมาก";
	} else if($Percent >= 70.00 && $Percent <=79.99) {
		return "ดี";
	} else if($Percent >= 60.00 && $Percent <=69.99) {
		return "ค่อนข้างดี";
	} else if($Percent >= 50.00 && $Percent <=59.99 ) {
		return "พอใช้";
	} else {
		return "ปรับปรุง";
	}
}

?>