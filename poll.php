<?php
//============================
//	Filename: poll.php
//	Version : 0.0.1
//	Author  : tongwoojun
//	Data    : 2012-xx-xx
//============================
if(!empty($_COOKIE["wenda2013"])){
	json_putout(array("message"=>"对不起，您已经参加过了"));
	exit;
}
require_once "mainfile.php";
if(empty($_POST)){
	json_putout(array("message"=>"请您填写完答卷。"));
	exit;
}

$result[1] = !empty($_POST['question01'])?$_POST['question01']:'';
$error     = array();
if(empty($result[1])){
	array_push($error,'01');
}

$select_result  = !empty($_POST['question02'])?$_POST['question02']:'';
if(empty($select_result)){
	array_push($error,'02');
}

if(!empty($select_result[0])){
	$result[3] = !empty($_POST['question03'])?$_POST['question03']:'';
	if(empty($result[3])){
		array_push($error,'03');
	}
	$result[4] = !empty($_POST['question04'])?$_POST['question04']:'';
	if(empty($result[4])){
		array_push($error,'04');
	}
	$result[5] = !empty($_POST['question05'])?$_POST['question05']:'';
	if(empty($result[5])){
		array_push($error,'05');
	}
}

if(!empty($select_result[1])){
	$result[6]  = !empty($_POST['question06'])?$_POST['question06']:'';
	if(empty($result[6])){
		array_push($error,'06');
	}
	$result[7]  = !empty($_POST['question07'])?$_POST['question07']:'';
	if(empty($result[7])){
		array_push($error,'07');
	}
	$result[8]  = !empty($_POST['question08'])?$_POST['question08']:'';
	if(empty($result[8])){
		array_push($error,'08');
	}
}

if(!empty($select_result[2])){
	$result[9]  = !empty($_POST['question09'])?$_POST['question09']:'';
	if(empty($result[9])){
		array_push($error,'09');
	}
	$result[10] = !empty($_POST['question010'])?$_POST['question010']:'';
	if(empty($result[10])){
		array_push($error,'010');
	}
	$result[11] = !empty($_POST['question011'])?$_POST['question011']:'';
	if(empty($result[11])){
		array_push($error,'011');
	}
}

if(!empty($select_result[3])){
	$result[12] = !empty($_POST['question012'])?$_POST['question012']:'';
	if(empty($result[12])){
		array_push($error,'012');
	}
	$result[13] = !empty($_POST['question013'])?$_POST['question013']:'';
	if(empty($result[13])){
		array_push($error,'013');
	}
	$result[14] = !empty($_POST['question014'])?$_POST['question014']:'';
	if(empty($result[14])){
		array_push($error,'014');
	}
}

if(!empty($select_result[4])){
	$result[15] = !empty($_POST['question015'])?$_POST['question015']:'';
	if(empty($result[15])){
		array_push($error,'015');
	}
	$result[16] = !empty($_POST['question016'])?$_POST['question016']:'';
	if(empty($result[16])){
		array_push($error,'016');
	}
	$result[17] = !empty($_POST['question017'])?$_POST['question017']:'';
	if(empty($result[17])){
		array_push($error,'017');
	}
}

if(!empty($select_result[5])){
	$result[18] = !empty($_POST['question018'])?$_POST['question018']:'';
	if(empty($result[18])){
		array_push($error,'018');
	}
	$result[19] = !empty($_POST['question019'])?$_POST['question019']:'';
	if(empty($result[19])){
		array_push($error,'019');
	}
	$result[20] = !empty($_POST['question020'])?$_POST['question020']:'';
	if(empty($result[20])){
		array_push($error,'020');
	}
}
if(is_array($select_result)){
	foreach($select_result as $v){
		$result[2] .= $v.",";
	}
}

$result[21] = !empty($_POST['question021'])?$_POST['question021']:'';
if(empty($result[21])){
	array_push($error,'021');
}
$result[22] = !empty($_POST['question022'])?$_POST['question022']:'';
if(empty($result[22])){
	array_push($error,'022');
}
$result[23] = !empty($_POST['question023'])?$_POST['question023']:'';
if(empty($result[23])){
	array_push($error,'023');
}

if(!empty($error)){
	json_putout(array("message"=>"请您填写完答卷。",'id'=>$error));
	exit;
}

$ip  = get_ip();
$now = time();
setcookie("wenda2013", $now,$now + 365*24*3600);
$sql = '';
$db  = new myAdodb ();
foreach($result as $key =>$value){
	$qresult = iconv("utf-8","GBK",$value);
	$db->insert("wd_result",array('tid'=>'1','qid'=>$key,'qresult'=>$qresult,'usercookice'=>$now,'username'=>null,'userip'=>$ip,'time'=>$now));
}
json_putout(array("message"=>"谢谢您的参与！",'id'=>'0'));
exit;



function json_putout($array) {
	$json = json_encode($array);
	echo $json;
}

function get_ip(){
    static $realip;
    if (isset($_SERVER)){
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")){
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
    return $realip;
}
?>