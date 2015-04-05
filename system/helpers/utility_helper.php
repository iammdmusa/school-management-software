<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('notification'))
{
    function notification($message)
    {
        $_SESSION['notification'] = $message;
    }
}
if(!function_exists('isHTTPS'))
{
    function isHTTPS()
    {
		if(isset($_SERVER['HTTPS']))
		{
        	return strtolower($_SERVER['HTTPS'])  == 'on';
		}
		return false;
    }
}
if(!function_exists('isPostBack'))
{
    function isPostBack()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
}

if(!function_exists('message'))
{
    function message($message)
    {
        $_SESSION['message'] = $message;
    }
}

if(!function_exists('exception'))
{
    function exception($message)
    {
        $_SESSION['exception'] = $message;
    }
}


if(!function_exists('dumpVar'))
{
    function dumpVar($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        exit();
    }
}

if(! function_exists('get_country_states'))
{
    function get_country_states($country_id = '')
    {

        if($country_id == 'US')
        {
        return array(   "AL" => "Alabama",
                        "AK" => "Alaska",
                        "AZ" => "Arizona",
                        "AR" => "Arkansas",
                        "CA" => "California",
                        "CO" => "Colorado",
                        "CT" => "Connecticut",
                        "DC" => "District of Columbia",
                        "DE" => "Delaware",
                        "FL" => "Florida",
                        "GA" => "Georgia",
                        "HI" => "Hawaii",
                        "ID" => "Idaho",
                        "IL" => "Illinois",
                        "IN" => "Indiana",
                        "IA" => "Iowa",
                        "KS" => "Kansas",
                        "KY" => "Kentucky",
                        "LA" => "Louisiana",
                        "ME" => "Maine",
                        "MD" => "Maryland",
                        "MA" => "Massachusetts",
                        "MI" => "Michigan",
                        "MN" => "Minnesota",
                        "MS" => "Mississippi",
                        "MO" => "Missouri",
                        "MT" => "Montana",
                        "NE" => "Nebraska",
                        "NV" => "Nevada",
                        "NH" => "New Hampshire",
                        "NJ" => "New Jersey",
                        "NM" => "New Mexico",
                        "NY" => "New York",
                        "NC" => "North Carolina",
                        "ND" => "North Dakota",
                        "OH" => "Ohio",
                        "OK" => "Oklahoma",
                        "OR" => "Oregon",
                        "PA" => "Pennsylvania",
                        "RI" => "Rhode Island",
                        "SC" => "South Carolina",
                        "SD" => "South Dakota",
                        "TN" => "Tennessee",
                        "TX" => "Texas",
                        "UT" => "Utah",
                        "VT" => "Vermont",
                        "VA" => "Virginia",
                        "WA" => "Washington",
                        "WV" => "West Virginia",
                        "WI" => "Wisconsin",
                        "WY" => "Wyoming");
        }
        if($country_id == 'AU')
        {
        return array(   "ACT" => "ACT",
                        "NSW" => "NSW",
                        "NTX" => "NTX",
                        "QLD" => "QLD",
                        "SA" => "SA",
                        "TAS" => "TAS",
                        "VIC" => "VIC",
                        "WAX" => "WAX");
        }
        if($country_id == 'CA')
        {
        return array(   "ALB" => "Alberta",
                        "BC" => "British Columbia",
                        "MTB" => "Manitoba",
                        "NB" => "New Brunswick",
                        "NF" => "Newfoundland",
                        "NT" => "Northwest Territory",
                        "NS" => "Nova Scotia",
                        "NU" => "Nunavut",
                        "ON" => "Ontario",
                        "PE" => "Prince Edward Island",
                        "QB" => "Quebec",
                        "SW" => "Saskatchewan",
                        "YU" => "Yukon");
        }
        if($country_id == '')
        {
        return array();
        }
    }
}

if(!function_exists('getCountryList'))
{
    function getCountryList()
    {
        return array(   'US' => 'United States',
                        'GB' => 'United Kingdom',
                        'CA' => 'Canada',
                        'AU' => 'Australia',
                        'AL' => 'Albania',
                        'DZ' => 'Algeria',
                        'AS' => 'American Samoa',
                        'AD' => 'Andorra',
                        'AO' => 'Angola',
                        'AI' => 'Anguilla',
                        'AQ' => 'Antarctica',
                        'AG' => 'Antigua And Barbuda',
                        'AR' => 'Argentina',
                        'AM' => 'Armenia',
                        'AW' => 'Aruba',
                        'AT' => 'Austria',
                        'AZ' => 'Azerbaijan',
                        'BS' => 'Bahamas',
                        'BH' => 'Bahrain',
                        'BD' => 'Bangladesh',
                        'BB' => 'Barbados',
                        'BY' => 'Belarus',
                        'BE' => 'Belgium',
                        'BZ' => 'Belize',
                        'BJ' => 'Benin',
                        'BM' => 'Bermuda',
                        'BT' => 'Bhutan',
                        'BO' => 'Bolivia',
                        'BA' => 'Bosnia And Herzegovina',
                        'BW' => 'Botswana',
                        'BV' => 'Bouvet Island',
                        'BR' => 'Brazil',
                        'IO' => 'British Indian Ocean Territory',
                        'BN' => 'Brunei Darussalam',
                        'BG' => 'Bulgaria',
                        'BF' => 'Burkina Faso',
                        'BI' => 'Burundi',
                        'KH' => 'Cambodia',
                        'CM' => 'Cameroon',
                        'CV' => 'Cape Verde',
                        'KY' => 'Cayman Islands',
                        'CF' => 'Central African Republic',
                        'TD' => 'Chad',
                        'CL' => 'Chile',
                        'CN' => 'China',
                        'CX' => 'Christmas Island',
                        'CC' => 'Cocos (Keeling) Islands',
                        'CO' => 'Colombia',
                        'KM' => 'Comoros',
                        'CG' => 'Congo',
                        'CD' => 'Congo ; The Dem. Rep. Of The',
                        'CK' => 'Cook Islands',
                        'CR' => 'Costa Rica',
                        'CI' => 'Cote D\'ivoire',
                        'HR' => 'Croatia',
                        'CY' => 'Cyprus',
                        'CZ' => 'Czech Republic',
                        'DK' => 'Denmark',
                        'DJ' => 'Djibouti',
                        'DM' => 'Dominica',
                        'DO' => 'Dominican Republic',
                        'TP' => 'East Timor',
                        'EC' => 'Ecuador',
                        'EG' => 'Egypt',
                        'SV' => 'El Salvador',
                        'GQ' => 'Equatorial Guinea',
                        'ER' => 'Eritrea',
                        'EE' => 'Estonia',
                        'ET' => 'Ethiopia',
                        'FK' => 'Falkland Islands (Malvinas)',
                        'FO' => 'Faroe Islands',
                        'FJ' => 'Fiji',
                        'FI' => 'Finland',
                        'FR' => 'France',
                        'GF' => 'French Guiana',
                        'PF' => 'French Polynesia',
                        'TF' => 'French Southern Territories',
                        'GA' => 'Gabon',
                        'GM' => 'Gambia',
                        'GE' => 'Georgia',
                        'DE' => 'Germany',
                        'GH' => 'Ghana',
                        'GI' => 'Gibraltar',
                        'GR' => 'Greece',
                        'GL' => 'Greenland',
                        'GD' => 'Grenada',
                        'GP' => 'Guadeloupe',
                        'GU' => 'Guam',
                        'GT' => 'Guatemala',
                        'GN' => 'Guinea',
                        'GW' => 'Guinea-Bissau',
                        'GY' => 'Guyana',
                        'HT' => 'Haiti',
                        'HM' => 'Heard Island And Mcdonald Islands',
                        'VA' => 'Holy See (Vatican City State)',
                        'HN' => 'Honduras',
                        'HK' => 'Hong Kong',
                        'HU' => 'Hungary',
                        'IS' => 'Iceland',
                        'IN' => 'India',
                        'ID' => 'Indonesia',
                        'IE' => 'Ireland',
                        'IL' => 'Israel',
                        'IT' => 'Italy',
                        'JM' => 'Jamaica',
                        'JP' => 'Japan',
                        'JO' => 'Jordan',
                        'KZ' => 'Kazakstan',
                        'KE' => 'Kenya',
                        'KI' => 'Kiribati',
                        'KW' => 'Kuwait',
                        'KG' => 'Kyrgyzstan',
                        'LA' => 'Lao People\'s Democratic Republic',
                        'LV' => 'Latvia',
                        'LB' => 'Lebanon',
                        'LS' => 'Lesotho',
                        'LY' => 'Libya',
                        'LI' => 'Liechtenstein',
                        'LT' => 'Lithuania',
                        'LU' => 'Luxembourg',
                        'MO' => 'Macau',
                        'MK' => 'Macedonia',
                        'MG' => 'Madagascar',
                        'MW' => 'Malawi',
                        'MY' => 'Malaysia',
                        'MV' => 'Maldives',
                        'ML' => 'Mali',
                        'MT' => 'Malta',
                        'MH' => 'Marshall Islands',
                        'MQ' => 'Martinique',
                        'MR' => 'Mauritania',
                        'MU' => 'Mauritius',
                        'YT' => 'Mayotte',
                        'MX' => 'Mexico',
                        'FM' => 'Micronesia; Federated States Of',
                        'MD' => 'Moldova; Republic Of',
                        'MC' => 'Monaco',
                        'MN' => 'Mongolia',
                        'MS' => 'Montserrat',
                        'MA' => 'Morocco',
                        'MZ' => 'Mozambique',
                        'NA' => 'Namibia',
                        'NR' => 'Nauru',
                        'NP' => 'Nepal',
                        'NL' => 'Netherlands',
                        'AN' => 'Netherlands Antilles',
                        'NC' => 'New Caledonia',
                        'NZ' => 'New Zealand',
                        'NI' => 'Nicaragua',
                        'NE' => 'Niger',
                        'NG' => 'Nigeria',
                        'NU' => 'Niue',
                        'NF' => 'Norfolk Island',
                        'MP' => 'Northern Mariana Islands',
                        'NO' => 'Norway',
                        'OM' => 'Oman',
                        'PK' => 'Pakistan',
                        'PW' => 'Palau',
                        'PS' => 'Palestinian Territory; Occupied',
                        'PA' => 'Panama',
                        'PG' => 'Papua New Guinea',
                        'PY' => 'Paraguay',
                        'PE' => 'Peru',
                        'PH' => 'Philippines',
                        'PN' => 'Pitcairn',
                        'PL' => 'Poland',
                        'PT' => 'Portugal',
                        'PR' => 'Puerto Rico',
                        'QA' => 'Qatar',
                        'RE' => 'Reunion',
                        'RO' => 'Romania',
                        'RU' => 'Russian Federation',
                        'RW' => 'Rwanda',
                        'SH' => 'Saint Helena',
                        'KN' => 'Saint Kitts And Nevis',
                        'LC' => 'Saint Lucia',
                        'PM' => 'Saint Pierre And Miquelon',
                        'VC' => 'Saint Vincent And The Grenadines',
                        'WS' => 'Samoa',
                        'SM' => 'San Marino',
                        'ST' => 'Sao Tome And Principe',
                        'SA' => 'Saudi Arabia',
                        'SN' => 'Senegal',
                        'SC' => 'Seychelles',
                        'SG' => 'Singapore',
                        'SK' => 'Slovakia',
                        'SI' => 'Slovenia',
                        'SB' => 'Solomon Islands',
                        'SO' => 'Somalia',
                        'ZA' => 'South Africa',
                        'GS' => 'South Georgia / South Sandwich Islands',
                        'ES' => 'Spain',
                        'LK' => 'Sri Lanka',
                        'SR' => 'Suriname',
                        'SJ' => 'Svalbard And Jan Mayen',
                        'SZ' => 'Swaziland',
                        'SE' => 'Sweden',
                        'CH' => 'Switzerland',
                        'SY' => 'Syrian Arab Republic',
                        'TW' => 'Taiwan',
                        'TJ' => 'Tajikistan',
                        'TZ' => 'Tanzania; United Republic Of',
                        'TH' => 'Thailand',
                        'TG' => 'Togo',
                        'TK' => 'Tokelau',
                        'TO' => 'Tonga',
                        'TT' => 'Trinidad And Tobago',
                        'TN' => 'Tunisia',
                        'TR' => 'Turkey',
                        'TM' => 'Turkmenistan',
                        'TC' => 'Turks And Caicos Islands',
                        'TV' => 'Tuvalu',
                        'UG' => 'Uganda',
                        'UA' => 'Ukraine',
                        'AE' => 'United Arab Emirates',
                        'UM' => 'United States Minor Outlying Islands',
                        'UY' => 'Uruguay',
                        'UZ' => 'Uzbekistan',
                        'VU' => 'Vanuatu',
                        'VE' => 'Venezuela',
                        'VN' => 'Viet Nam',
                        'VG' => 'Virgin Islands; British',
                        'VI' => 'Virgin Islands; U.S.',
                        'WF' => 'Wallis And Futuna',
                        'EH' => 'Western Sahara',
                        'YE' => 'Yemen',
                        'YU' => 'Yugoslavia',
                        'ZM' => 'Zambia'
                    );

    }
}
if(!function_exists('getCountryFullName'))
{
    function getCountryFullName($abbr)
    {
        if(strlen($abbr) == 2)
        {
            $countries = getCountryList();

            return isset($countries[$abbr]) ? $countries[$abbr] : '';
        }
        return $abbr;
    }
}

if(!function_exists('is_admin_loggedin'))
{
    function is_admin_loggedin()
    {
        if(isset($_SESSION['is_admin_loggedin']) && $_SESSION['is_admin_loggedin'] == '1')
        {
           return true; 
        }
        else
        {
            return false; 
        }
    }
}




if(!function_exists('row_array'))
{
    function row_array($sql)
    {
        $result = array(); 
        $query = mysql_query($sql);    
        $data = mysql_fetch_assoc($query);    
        return $data; 
    }
}

if(!function_exists('result_array'))
{
    function result_array($sql)
    {
        $result = array(); 
        $query = mysql_query($sql);
        while($data = mysql_fetch_array($query))
        {
            $result[] =  $data;
        }
        $rows = count($result);
        if($rows)
        {
            $total_global_rows = count($result);
            $total_inner_rows =  count($result[0]);
            $count_total_inner_rows = $total_inner_rows/2;

            for($i = 0;$i<$total_global_rows;$i++)
            {
                for($j=0;$j<$count_total_inner_rows;$j++)
                {
                    unset($result[$i][$j]);        
                }    
            }
        }    
        return $result;    
    }
}

if(!function_exists('student_position'))
{        
    function student_position($student_id,$school_id)
    {
       $sql = "SELECT position FROM scl_result_summary WHERE student_id = $student_id AND $school_id = $school_id LIMIT 1";
       #dumpVar($sql);
       $row = row_array($sql);
       return $row['position'];
    }
}

if(!function_exists('grade_with_points'))
{    
    function grade_with_points($grade_id)
    {
        if($grade_id == 'A+')
        {
            $Obtained_GPA_v2 = '5.00';  
            $Obtained_GPA = 'A+';               
        }
        else if($grade_id == 'A')
        {
            $Obtained_GPA_v2 = '4.50';  
            $Obtained_GPA = 'A';               
        }
        else if($grade_id == 'A-')
        {
            $Obtained_GPA_v2 = '4.00';  
            $Obtained_GPA = 'A-';               
        }
        else if($grade_id == 'B+')
        {
            $Obtained_GPA_v2 = '3.50';  
            $Obtained_GPA = 'B+';               
        }
        else if($grade_id == 'B')
        {
            $Obtained_GPA_v2 = '3.00';  
            $Obtained_GPA = 'B';               
        }
        else if($grade_id == 'C')
        {
            $Obtained_GPA_v2 = '2.50';  
            $Obtained_GPA = 'C';               
        }
        else
        {
            $Obtained_GPA_v2 = '0.00';  
            $Obtained_GPA = 'F';               
        }
        
        $data['Obtained_GPA_v2'] = $Obtained_GPA_v2;
        $data['Obtained_GPA'] = $Obtained_GPA;
        return $data;
    }
}
if(!function_exists('get_letter_grade'))
{
    function get_letter_grade($grade_point)
    {
        if($grade_point == 5)
        {
           return 'A+'; 
        }
        else if($grade_point>=4.5 && $grade_point<5)
        {
           return 'A'; 
        }
        else if($grade_point>=4.0 && $grade_point<4.5)
        {
           return 'A-'; 
        }
        else if($grade_point>=3.5 && $grade_point<4.0)
        {
           return 'B+'; 
        }
        else if($grade_point>=3.0 && $grade_point<3.5)
        {
           return 'B'; 
        }
        else if($grade_point>=2.5 && $grade_point<3)
        {
           return 'C'; 
        }
        else
        {
           return 'F'; 
        }
    }
}
if(!function_exists('base64url_encode'))
{
    function base64url_encode($data)
    {
        $new_value = base64_encode($data);
        $new_value = base64_encode($new_value);
        $new_value = base64_encode($new_value);
        $new_value = base64_encode($new_value);
        $new_value = base64_encode($new_value);
        return rtrim(strtr(base64_encode($new_value), '+/', '-_'), '='); 
    }
}
if(!function_exists('base64url_decode'))
{
    function base64url_decode($data)
    {
        $new_value = base64_decode($data);
        $new_value = base64_decode($new_value);
        $new_value = base64_decode($new_value);
        $new_value = base64_decode($new_value);
        $new_value = base64_decode($new_value);
        return base64_decode(str_pad(strtr($new_value, '-_', '+/'), strlen($new_value) % 4, '=', STR_PAD_RIGHT)); 
    }
}

if(!function_exists('dateDiff'))
{
    function dateDiff($date2,$date1)
    {
       if(empty($date2) || empty($date1)) {
        return "No date provided";
    }
    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");
 
    //$now             = time();
    $now             = strtotime($date1);
    $unix_date         = strtotime($date2);
 
       // check validity of date
    if(empty($unix_date)) {    
        return "Bad date";
    }
 
    // is it future date or past date
    if($now > $unix_date) {    
        $difference     = $now - $unix_date;
        #$tense         = "ago";
        $tense         = "";
 
    } else {
        $difference     = $unix_date - $now;
        #$tense         = "from now";
        $tense         = "";
    }
 
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
 
    $difference = round($difference);
 
    if($difference != 1) {
        $periods[$j].= "s";
    }
    return "$difference $periods[$j] {$tense}";
    }
    
    function aasort(&$array, $key) 
    {
        $sorter=array();
        $ret=array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii]=$va[$key];
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii]=$array[$ii];
        }
        $array=$ret;
        return $array;
    }
}
?>