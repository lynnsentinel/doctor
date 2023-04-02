<?php  
    
    function connection(){
        $host = "localhost";
        $username = "root";
        $password ="";
        $dbname = "doctor_appointment"; 		
        $conn = mysqli_connect($host, $username, $password, $dbname);
        mysqli_query($conn, "SET CHARACTER SET UTF8");
        return $conn;
    }

    function base_url(){
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        return $url."/doctor/";
    }

    function checkSecurity($ret, $encrypt=false){
        $keySecurity = "doctor";
        $ret = str_replace("'","",$ret);
        $ret = str_replace('"',"",$ret);

        if ($encrypt) {
            $ret = md5($ret.$keySecurity);
        }

        return $ret;
    }

    function query($conn, $sql){
        $res = mysqli_query($conn, $sql);
        return $res;
    }

    function fetch_array($res, $while=false){
        if ($while) {
            $rs = array();
            while($tmp = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                array_push($rs, $tmp);
            }
        } else {
            $rs = mysqli_fetch_array($res, MYSQLI_ASSOC);
        }
        return $rs;
    }

    function dateToDB($date){	//date dd/mm/yyyy -- > yyyy/mm/dd
        $ret = "";
		if ($date != "" && $date != null){
			if(substr($date,6) >2500 ){
				$ret = strval((substr($date, 6)-543)."-".substr($date, 3, 2)."-".substr($date, 0, 2));
			}else{
				$ret = strval(substr($date, 6)."-".substr($date, 3, 2)."-".substr($date, 0, 2));
			}
		}else{
 			$ret = "null";
		}
		return $ret;
	}

    function dateToPage($date){	//date  yyyy/mm/dd  -- > dd/mm/yyyy
        $ret = "";
		if ($date != "" && $date != null ){
			$date = str_replace('-', '/', $date);	 
			if( substr($date,0,4) >2500 ){
				$ret = (substr($date, 8, 10))."/".substr($date, 5, 2)."/".(substr($date, 0, 4)-543);
			}else{
				$ret = (substr($date, 8, 10))."/".substr($date, 5, 2)."/".substr($date, 0, 4) ;
			}
		}
		return $ret;
	}

    function dateTimeToPage($date){	//date  yyyy/mm/dd  -- > dd/mm/yyyy
		$ret = "";
		if ($date != "" && $date != null){
			$date = str_replace('-', '/', $date);	 
			if( substr($date,0,4) >2500 ){
				$ret = (substr($date, 8, 2))."/".substr($date, 5, 2)."/".(substr($date, 0, 4)-543)." ".substr($date, 11) ;
			}else{
				$ret = (substr($date, 8, 2))."/".substr($date, 5, 2)."/".substr($date, 0, 4)." ".substr($date, 11);
			}
 		}else{
 			$ret = "";
		}
		return $ret;
	}

?>