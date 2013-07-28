<?php
class OS_BR{

    private $agent = "";
    private $info = array();

    function __construct(){
        $this->agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : NULL;
        $this->getBrowser();
    }

    function getBrowser(){
        $browser = array("Navigator"            => "/Navigator(.*)/i",
                         "Firefox"              => "/Firefox(.*)/i",
                         "Internet Explorer"    => "/MSIE(.*)/i",
                         "Google Chrome"        => "/chrome(.*)/i",
                         "MAXTHON"              => "/MAXTHON(.*)/i",
                         "Opera"                => "/Opera(.*)/i",
                         );
        foreach($browser as $key => $value){
            if(preg_match($value, $this->agent)){
                $this->info = array_merge($this->info,array("Browser" => $key));
                $this->info = array_merge($this->info,array(
                  "Version" => $this->getVersion($key, $value, $this->agent)));
                break;
            }else{
                $this->info = array_merge($this->info,array("Browser" => "UnKnown"));
                $this->info = array_merge($this->info,array("Version" => "UnKnown"));
            }
        }
        return $this->info['Browser'];
    }

    function getVersion($browser, $search, $string){
        $browser = $this->info['Browser'];
        $version = "";
        $browser = strtolower($browser);
        preg_match_all($search,$string,$match);
        switch($browser){
            case "firefox": $version = str_replace("/","",$match[1][0]);
            break;

            case "internet explorer": $version = substr($match[1][0],0,4);
            break;

            case "opera": $version = str_replace("/","",substr($match[1][0],0,5));
            break;

            case "navigator": $version = substr($match[1][0],1,7);
            break;

            case "maxthon": $version = str_replace(")","",$match[1][0]);
            break;

            case "google chrome": $version = substr($match[1][0],1,10);
        }
        return $version;
    }

    function showInfo($switch){
        $switch = strtolower($switch);
        switch($switch){
            case "browser": return $this->info['Browser'];
            break;

            case "os": return $this->info['Operating System'];
            break;

            case "version": return $this->info['Version'];
            break;

            case "all" : return array($this->info["Version"], 
              $this->info['Operating System'], $this->info['Browser']);
            break;

            default: return "Unkown";
            break;

        }
    }
}
//
function getOS($userAgent) {
  // Create list of operating systems with operating system name as array key 
	$oses = array (
		'iPhone' => '(iPhone)',
		'Windows 3.11' => 'Win16',
		'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)', // Use regular expressions as value to identify operating system
		'Windows 98' => '(Windows 98)|(Win98)',
		'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
		'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
		'Windows 2003' => '(Windows NT 5.2)',
		'Windows Vista' => '(Windows NT 6.0)|(Windows Vista)',
		'Windows 7' => '(Windows NT 6.1)|(Windows 7)',
		'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
		'Windows ME' => 'Windows ME',
		'Open BSD'=>'OpenBSD',
		'Sun OS'=>'SunOS',
		'Android'=>'Android',
		'Linux'=>'(Linux)|(X11)',
		'Safari' => '(Safari)',
		'Macintosh'=>'(Mac_PowerPC)|(Macintosh)',
		'QNX'=>'QNX',
		'BeOS'=>'BeOS',
		'OS/2'=>'OS/2',
		'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp/cat)|(msnbot)|(ia_archiver)'
	);

	foreach($oses as $os=>$pattern){ // Loop through $oses array
    // Use regular expressions to check operating system type
		if(eregi($pattern, $userAgent)) { // Check if a value in $oses array matches current user agent.
			return $os; // Operating system was matched so return $oses key
		}
	}
	return 'Unknown'; // Cannot find operating system so return Unknown
}

// using
$obj = new OS_BR();
// get all information and it returns an array
$country = file_get_contents('http://api.hostip.info/country.php?ip='.$_SERVER['REMOTE_ADDR']); 
// Below is the example IP from canada. 
//$country = file_get_contents('http://api.hostip.info/country.php?ip=192.197.121.3'); 

$time = date('d-m-Y H:i');
$date = date('d-m-Y', strtotime($time));
$nTime = date('H:i', strtotime($time));


?>