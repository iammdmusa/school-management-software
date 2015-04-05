// JavaScript Document

//var states = {
//			"AL" :	"Alabama",
//			"AK" :	"Alaska",
//			"AS" :	"American Samoa",
//			"AZ" :	"Arizona",
//			"AR" :	"Arkansas",
//			"CA" :	"California",
//			"CO" :	"Colorado",
//			"CT" :	"Connecticut",
//			"DE" :	"Delaware",
//			"DC" :	"District of Columbia",
//			"FM" :	"Federated States of Micronesia",
//			"FL" :	"Florida",
//			"GA" :	"Georgia",
//			"GU" :	"Guam",
//			"HI" :	"Hawaii",
//			"ID" :	"Idaho",
//			"IL" :	"Illinois",
//			"IN" :	"Indiana",
//			"IA" :	"Iowa",
//			"KS" :	"Kansas",
//			"KY" :	"Kentucky",
//			"LA" :	"Louisiana",
//			"ME" :	"Maine",
//			"MH" :	"Marshall Islands",
//			"MD" :	"Maryland",
//			"MA" :	"Massachusetts",
//			"MI" :	"Michigan",
//			"MN" :	"Minnesota",
//			"MS" :	"Mississippi",
//			"MO" :	"Missouri",
//			"MT" :	"Montana",
//			"NE" :	"Nebraska",
//			"NV" :	"Nevada",
//			"NH" :	"New Hampshire",
//			"NJ" :	"New Jersey",
//			"NM" :	"New Mexico",
//			"NY" :	"New York",
//			"NC" :	"North Carolina",
//			"ND" :	"North Dakota",
//			"MP" :	"Northern Mariana Islands",
//			"OH" :	"Ohio",
//			"OK" :	"Oklahoma",
//			"OR" :	"Oregon",
//			"PW" :	"Palau",
//			"PA" :	"Pennsylvania",
//			"PR" :	"Puerto Rico",
//			"RI" :	"Rhode Island",
//			"SC" :	"South Carolina",
//			"SD" :	"South Dakota",
//			"TN" :	"Tennessee",
//			"TX" :	"Texas",
//			"UT" :	"Utah",
//			"VT" :	"Vermont",
//			"VI" :	"Virgin Islands",
//			"VA" :	"Virginia",
//			"WA" :	"Washington",
//			"WV" :	"West Virginia",
//			"WI" :	"Wisconsin",
//			"WY" :	"Wyoming"
//			};

    var states = {

			"AL" :	"Alabama",
			"AK" :	"Alaska",
			"AZ" :	"Arizona",
			"AR" :	"Arkansas",
			"CA" :	"California",
			"CO" :	"Colorado",
			"CT" :	"Connecticut",
			"DC" :  "District of Columbia",
			"DE" :	"Delaware",
			"FL" :	"Florida",
			"GA" :	"Georgia",
			"GU" :	"Guam",
			"HI" :	"Hawaii",
			"ID" :	"Idaho",
			"IL" :	"Illinois",
			"IN" :	"Indiana",
			"IA" :	"Iowa",
			"KS" :	"Kansas",
			"KY" :	"Kentucky",
			"LA" :	"Louisiana",
			"ME" :	"Maine",
			"MD" :	"Maryland",
			"MA" :	"Massachusetts",
			"MI" :	"Michigan",
			"MN" :	"Minnesota",
			"MS" :	"Mississippi",
			"MO" :	"Missouri",
			"MT" :	"Montana",
			"NE" :	"Nebraska",
			"NV" :	"Nevada",
			"NH" :	"New Hampshire",
			"NJ" :	"New Jersey",
			"NM" :	"New Mexico",
			"NY" :	"New York",
			"NC" :	"North Carolina",
			"ND" :	"North Dakota",
			"OH" :	"Ohio",
			"OK" :	"Oklahoma",
			"OR" :	"Oregon",
			"PA" :	"Pennsylvania",
			"RI" :	"Rhode Island",
			"SC" :	"South Carolina",
			"SD" :	"South Dakota",
			"TN" :	"Tennessee",
			"TX" :	"Texas",
			"UT" :	"Utah",
			"VT" :	"Vermont",
			"VA" :	"Virginia",
			"WA" :	"Washington",
			"WV" :	"West Virginia",
			"WI" :	"Wisconsin",
			"WY" :	"Wyoming"
			};


    var states_ca = {
			"AB" :	"Alberta",
			"BC" :	"British Columbia",
			"MB" :	"Manitoba",
			"NB" :	"New Brunswick",
			"NL" :	"Newfoundland and Labrador",
			"NT" :	"Northwest Territories",
			"NS" :	"Nova Scotia",
			"NU" :	"Nunavut",
			"ON" :	"Ontario",
			"PE" :	"Prince Edward Island",
			"QC" :	"Quebec",
			"SK" :	"Saskatchewan",
			"YT" :	"Yukon"
			};

function printStateOptions()
{
	for(key in states)
	{
		document.write('<option value="' + key + '">' + states[key] + '</option>');
	}
}

/*function returnBillingStateOptions()
{	//alert ("topon");
	var code= '<option value=" ">Select a State</option>';
	for(key in states)
	{
		code +='<option value="' + key + '" >' + states[key] + '</option>';
	}
	document.getElementById("customer_state").innerHTML=code;
}

function returnShippingStateOptions()
{	alert ("topon");
	var code= '<option value=" ">Select a State</option>';
	for(key in states)
	{
		code +='<option value="' + key + '" >' + states[key] + '</option>';
	}
	document.getElementById("shipping_state").innerHTML=code;
	alert(code);
}
*/
/* Added by Himel Nag Rana
 * for the purpose of defining state tax.
 */
function printDetailsStateOptions()
{
	for(key in states)
	{
		document.write('<option value="' + key + '">' +key+' - '+states[key] + '</option>');
	}
}
/*******************************************/
function getStateFullName(key)
{
	if(states[key] == undefined)
	{
		return key;
	}
	else
	{
		return states[key];
	}
}


var countrys = {
			"US" :	"United States",
			"GB" :	"United Kingdom",
			"CA" :	"Canada",
			"AU" :	"Australia",
			"AL" :	"Albania",
			"DZ" :	"Algeria",
			"AS" :	"American Samoa",
			"AD" :	"Andorra",
			"AO" :	"Angola",
			"AI" :	"Anguilla",
			"AQ" :	"Antarctica",
			"AG" :	"Antigua And Barbuda",
			"AR" :	"Argentina",
			"AM" :	"Armenia",
			"AW" :	"Aruba",
			"AU" :	"Australia",
			"AT" :	"Austria",
			"AZ" :	"Azerbaijan",
			"BS" :	"Bahamas",
			"BH" :	"Bahrain",
			"BD" :	"Bangladesh",
			"BB" :	"Barbados",
			"BY" :	"Belarus",
			"BE" :	"Belgium",
			"BZ" :	"Belize",
			"BJ" :	"Benin",
			"BM" :	"Bermuda",
			"BT" :	"Bhutan",
			"BO" :	"Bolivia",
			"BA" :	"Bosnia And Herzegovina",
			"BW" :	"Botswana",
			"BV" :	"Bouvet Island",
			"BR" :	"Brazil",
			"IO" :	"British Indian Ocean Territory",
			"BN" :	"Brunei Darussalam",
			"BG" :	"Bulgaria",
			"BF" :	"Burkina Faso",
			"BI" :	"Burundi",
			"KH" :	"Cambodia",
			"CM" :	"Cameroon",
			"CV" :	"Cape Verde",
			"KY" :	"Cayman Islands",
			"CF" :	"Central African Republic",
			"CI" :	"Channel Islands",
			"TD" :	"Chad",
			"CL" :	"Chile",
			"CN" :	"China",
			"CX" :	"Christmas Island",
			"CC" :	"Cocos (Keeling) Islands",
			"CO" :	"Colombia",
			"KM" :	"Comoros",
			"CG" :	"Congo",
			"CD" :	"Congo, The Dem. Rep. Of The",
			"CK" :	"Cook Islands",
			"CR" :	"Costa Rica",
			"CI" :	"Cote D'ivoire",
			"HR" :	"Croatia",
			"CY" :	"Cyprus",
			"CZ" :	"Czech Republic",
			"DK" :	"Denmark",
			"DJ" :	"Djibouti",
			"DM" :	"Dominica",
			"DO" :	"Dominican Republic",
			"TP" :	"East Timor",
			"EC" :	"Ecuador",
			"EG" :	"Egypt",
			"SV" :	"El Salvador",
			"GQ" :	"Equatorial Guinea",
			"ER" :	"Eritrea",
			"EE" :	"Estonia",
			"ET" :	"Ethiopia",
			"FK" :	"Falkland Islands (Malvinas)",
			"FO" :	"Faroe Islands",
			"FJ" :	"Fiji",
			"FI" :	"Finland",
			"FR" :	"France",
			"GF" :	"French Guiana",
			"PF" :	"French Polynesia",
			"TF" :	"French Southern Territories",
			"GA" :	"Gabon",
			"GM" :	"Gambia",
			"GE" :	"Georgia",
			"DE" :	"Germany",
			"GH" :	"Ghana",
			"GI" :	"Gibraltar",
			"GR" :	"Greece",
			"GL" :	"Greenland",
			"GD" :	"Grenada",
			"GP" :	"Guadeloupe",
			"GU" :	"Guam",
			"GT" :	"Guatemala",
			"GN" :	"Guinea",
			"GW" :	"Guinea-Bissau",
			"GY" :	"Guyana",
			"HT" :	"Haiti",
			"HM" :	"Heard Island And Mcdonald Islands",
			"VA" :	"Holy See (Vatican City State)",
			"HN" :	"Honduras",
			"HK" :	"Hong Kong",
			"HU" :	"Hungary",
			"IS" :	"Iceland",
			"IN" :	"India",
			"ID" :	"Indonesia",
			"IE" :	"Ireland",
			"IL" :	"Israel",
			"IT" :	"Italy",
			"JM" :	"Jamaica",
			"JP" :	"Japan",
			"JO" :	"Jordan",
			"KZ" :	"Kazakstan",
			"KE" :	"Kenya",
			"KI" :	"Kiribati",
			"KW" :	"Kuwait",
			"KG" :	"Kyrgyzstan",
			"LA" :	"Lao People's Democratic Republic",
			"LV" :	"Latvia",
			"LB" :	"Lebanon",
			"LS" :	"Lesotho",
			"LY" :	"Libya",
			"LI" :	"Liechtenstein",
			"LT" :	"Lithuania",
			"LU" :	"Luxembourg",
			"MO" :	"Macau",
			"MK" :	"Macedonia",
			"MG" :	"Madagascar",
			"MW" :	"Malawi",
			"MY" :	"Malaysia",
			"MV" :	"Maldives",
			"ML" :	"Mali",
			"MT" :	"Malta",
			"MH" :	"Marshall Islands",
			"MQ" :	"Martinique",
			"MR" :	"Mauritania",
			"MU" :	"Mauritius",
			"YT" :	"Mayotte",
			"MX" :	"Mexico",
			"FM" :	"Micronesia, Federated States Of",
			"MD" :	"Moldova, Republic Of",
			"MC" :	"Monaco",
			"MN" :	"Mongolia",
			"MS" :	"Montserrat",
			"MA" :	"Morocco",
			"MZ" :	"Mozambique",
			"NA" :	"Namibia",
			"NR" :	"Nauru",
			"NP" :	"Nepal",
			"NL" : 	"Netherlands",
			"AN" :	"Netherlands Antilles",
			"NC" :	"New Caledonia",
			"NZ" :	"New Zealand",
			"NI" :	"Nicaragua",
			"NE" :	"Niger",
			"NG" :	"Nigeria",
			"NU" :	"Niue",
			"NF" :	"Norfolk Island",
			"MP" :	"Northern Mariana Islands",
			"NO" :	"Norway",
			"OM" :	"Oman",
			"PK" :	"Pakistan",
			"PW" :	"Palau",
			"PS" :	"Palestinian Territory, Occupied",
			"PA" :	"Panama",
			"PG" :	"Papua New Guinea",
			"PY" :	"Paraguay",
			"PE" :	"Peru",
			"PH" :	"Philippines",
			"PN" :	"Pitcairn",
			"PL" :	"Poland",
			"PT" :	"Portugal",
			"PR" :	"Puerto Rico",
			"QA" :	"Qatar",
			"RE" :	"Reunion",
			"RO" :	"Romania",
			"RU" :	"Russian Federation",
			"RW" :	"Rwanda",
			"SH" :	"Saint Helena",
			"KN" :	"Saint Kitts And Nevis",
			"LC" :	"Saint Lucia",
			"PM" :	"Saint Pierre And Miquelon",
			"VC" :	"Saint Vincent And The Grenadines",
			"WS" :	"Samoa",
			"SM" :	"San Marino",
			"ST" :	"Sao Tome And Principe",
			"SA" :	"Saudi Arabia",
			"SN" :	"Senegal",
			"SC" :	"Seychelles",
			"SG" :	"Singapore",
			"SK" :	"Slovakia",
			"SI" :	"Slovenia",
			"SB" :	"Solomon Islands",
			"SO" :	"Somalia",
			"ZA" :	"South Africa",
			"GS" :	"South Georgia / South Sandwich Islands",
			"ES" :	"Spain",
			"LK" :	"Sri Lanka",
			"SR" :	"Suriname",
			"SJ" :	"Svalbard And Jan Mayen",
			"SZ" :	"Swaziland",
			"SE" :	"Sweden",
			"CH" :	"Switzerland",
			"SY" :	"Syrian Arab Republic",
			"TW" :	"Taiwan",
			"TJ" :	"Tajikistan",
			"TZ" :	"Tanzania, United Republic Of",
			"TH" :	"Thailand",
			"TG" :	"Togo",
			"TK" :	"Tokelau",
			"TO" :	"Tonga",
			"TT" :	"Trinidad And Tobago",
			"TN" :	"Tunisia",
			"TR" :	"Turkey",
			"TM" :	"Turkmenistan",
			"TC" :	"Turks And Caicos Islands",
			"TV" :	"Tuvalu",
			"UG" :	"Uganda",
			"UA" :	"Ukraine",
			"AE" :	"United Arab Emirates",
			"UM" :	"United States Minor Outlying Islands",
			"UY" :	"Uruguay",
			"UZ" :	"Uzbekistan",
			"VU" :	"Vanuatu",
			"VE" :	"Venezuela",
			"VN" :	"Viet Nam",
			"VG" :	"Virgin Islands, British",
			"VI" :	"Virgin Islands, U.S.",
			"WF" :	"Wallis And Futuna",
			"EH" :	"Western Sahara",
			"YE" :	"Yemen",
			"YU" :	"Yugoslavia",
			"ZM" :	"Zambia"
			};

function printCountryOptions()
{
	for(key in countrys)
	{
		document.write('<option value="' + key + '">' +countrys[key] + '</option>');
	}
}

/*function printCountryName(countryShortName)
{alert(countryShortName);
	for(key in countrys)
	{
		if(key == countryShortName)
			document.write(countrys[key]);
	}
}*/

function getCountryFullName(key)
{
	if(countrys[key] == undefined)
	{
		return "";
	}
	else
	{
		return countrys[key];
	}
}


/**
*author shafiul alam
*@param countryName,stateName,spanLabel,replacedString,onchangeText
*this function had four parameter country name,state name,coresponding span level and replacedString is the state of coresponding country.
*/

function showState(countryName,stateName,spanLabel,replacedString,onchangeText,className)
{
	var code ='';
	var pwc=document.getElementById(countryName).value;

	if(pwc=='US')
	{
		code ='<select class=\''+className+'\' name="'+stateName+'" id="'+stateName+'" required="1" exclude=" " realname="'+replacedString+'" '+onchangeText+'>';
	    code = code + '<option value=" ">Select State</option>';
		code = code + '<option value="Al">Alabama</option>';
		code = code + '<option value="AK">Alaska</option>';
		code = code + '<option value="AZ">Arizona</option>';
		code = code + '<option value="AR">Arkansas</option>';
		code = code + '<option value="CA">California</option>';
		code = code + '<option value="CO">Colorado</option>';
		code = code + '<option value="CT">Connecticut</option>';
		code = code + '<option value="DC">District of Columbia</option>';
		code = code + '<option value="DE">Delaware</option>';
		code = code + '<option value="FL">Florida</option>';
		code = code + '<option value="GA">Georgia</option>';
		code = code + '<option value="GU">Guam</option>';
		code = code + '<option value="HI">Hawaii</option>';
		code = code + '<option value="ID">Idaho</option>';
		code = code + '<option value="IL">Illinois</option>';
		code = code + '<option value="IN">Indiana</option>';
		code = code + '<option value="IA">Iowa</option>';
		code = code + '<option value="KS">Kansas</option>';
		code = code + '<option value="KY">Kentucky</option>';
		code = code + '<option value="LA">Louisiana</option>';
		code = code + '<option value="ME">Maine</option>';
		code = code + '<option value="MD">Maryland</option>';
		code = code + '<option value="MA">Massachusetts</option>';
		code = code + '<option value="MI">Michigan</option>';
		code = code + '<option value="MN">Minnesota</option>';
		code = code + '<option value="MS">Mississippi</option>';
		code = code + '<option value="MO">Missouri</option>';
		code = code + '<option value="MT">Montana</option>';
		code = code + '<option value="NE">Nebraska</option>';
		code = code + '<option value="NV">Nevada</option>';
		code = code + '<option value="NH">New Hampshire</option>';
		code = code + '<option value="NJ">New Jersey</option>';
		code = code + '<option value="NM">New Mexico</option>';
		code = code + '<option value="NY">New York</option>';
		code = code + '<option value="NC">North Carolina</option>';
		code = code + '<option value="ND">North Dakota</option>';
		code = code + '<option value="OH">Ohio</option>';
		code = code + '<option value="OK">Oklahoma</option>';
		code = code + '<option value="OR">Oregon</option>';
		code = code + '<option value="PA">Pennsylvania</option>';
		code = code + '<option value="RI">Rhode Island</option>';
		code = code + '<option value="SC">South Carolina</option>';
		code = code + '<option value="SD">South Dakota</option>';
		code = code + '<option value="TN">Tennessee</option>';
		code = code + '<option value="TX">Texas</option>';
		code = code + '<option value="UT">Utah</option>';
		code = code + '<option value="VT">Vermont</option>';
		code = code + '<option value="VA">Virginia</option>';
		code = code + '<option value="WA">Washington</option>';
		code = code + '<option value="WV">West Virginia</option>';
		code = code + '<option value="WI">Wisconsin</option>';
		code = code + '<option value="WY">Wyoming</option>';
        code = code + '<option value="AE">Armed Forces Europe</option>';
        code = code + '<option value="AP">Armed Forces Pacific</option>';
        code = code + '<option value="AA">Armed Forces America</option>';

        code = code + '<'+ '/'+ 'select>';
		code = code + ' <span class="required">*</span>';
     }
	else if(pwc=='CA')
	{
		code ='<select class=\''+className+'\' name="'+stateName+'" id="'+stateName+'" required="1" exclude=" " realname="'+replacedString+'" '+onchangeText+'>';
	    code = code + '<option value=" ">Select State</option>';
		code = code + '<option value="AB">Alberta</option>';
		code = code + '<option value="BC">British Columbia</option>';
		code = code + '<option value="MB">Manitoba</option>';
		code = code + '<option value="NB">New Brunswick</option>';
		code = code + '<option value="NL">Newfoundland and Labrador</option>';
		code = code + '<option value="NT">Northwest Territories</option>';
		code = code + '<option value="NS">Nova Scotia</option>';
		code = code + '<option value="NU">Nunavut</option>';
		code = code + '<option value="ON">Ontario</option>';
		code = code + '<option value="PE">Prince Edward Island</option>';
		code = code + '<option value="QC">Quebec</option>';
		code = code + '<option value="SK">Saskatchewan</option>';
		code = code + '<option value="YT">Yukon</option>';
        code = code + '<'+ '/'+ 'select>';
		code = code + ' <span class="required">*</span>';
     }
     else if(pwc=='')
     {
        code = '<input class=\''+className+'\'type=\'text\' size=\'36\' name="'+stateName+'" id="'+stateName+'" required="0" realname="'+replacedString+'">';
        code = code;
     }
	else
	{
		code = '<input class=\''+className+'\'type=\'text\' size=\'36\' name="'+stateName+'" id="'+stateName+'" required="1" realname="'+replacedString+'">';
		code = code + ' <span class="required">&nbsp;*<'+ '/'+ 'span>';

	}
	var span1 = spanLabel+"1";
	var span2 = spanLabel+"2";
	if(pwc=='GB')
	{
		document.getElementById(span1).innerHTML='County';
	}
	else
	{
		document.getElementById(span1).innerHTML='State / Province';
	}
	document.getElementById(span2).innerHTML=code;
}

function showAffiliateState(countryName,stateName,spanLabel,replacedString,onchangeText,className)
{
	var code ='';
	var pwc=document.getElementById(countryName).value;

	if(!className)
	{
		className = '';
	}

	if(pwc=='US')
	{
		code ='<select class=\''+className+'\' name="'+stateName+'" id="'+stateName+'" required="1" exclude=" " realname="'+replacedString+'" '+onchangeText+'>';
	    code = code + '<option value="">Select State</option>';
		code = code + '<option value="Al">Alabama</option>';
		code = code + '<option value="AK">Alaska</option>';
		code = code + '<option value="AZ">Arizona</option>';
		code = code + '<option value="AR">Arkansas</option>';
		code = code + '<option value="CA">California</option>';
		code = code + '<option value="CO">Colorado</option>';
		code = code + '<option value="CT">Connecticut</option>';
		code = code + '<option value="DC">District of Columbia</option>';
		code = code + '<option value="DE">Delaware</option>';
		code = code + '<option value="FL">Florida</option>';
		code = code + '<option value="GA">Georgia</option>';
		code = code + '<option value="GU">Guam</option>';
		code = code + '<option value="HI">Hawaii</option>';
		code = code + '<option value="ID">Idaho</option>';
		code = code + '<option value="IL">Illinois</option>';
		code = code + '<option value="IN">Indiana</option>';
		code = code + '<option value="IA">Iowa</option>';
		code = code + '<option value="KS">Kansas</option>';
		code = code + '<option value="KY">Kentucky</option>';
		code = code + '<option value="LA">Louisiana</option>';
		code = code + '<option value="ME">Maine</option>';
		code = code + '<option value="MD">Maryland</option>';
		code = code + '<option value="MA">Massachusetts</option>';
		code = code + '<option value="MI">Michigan</option>';
		code = code + '<option value="MN">Minnesota</option>';
		code = code + '<option value="MS">Mississippi</option>';
		code = code + '<option value="MO">Missouri</option>';
		code = code + '<option value="MT">Montana</option>';
		code = code + '<option value="NE">Nebraska</option>';
		code = code + '<option value="NV">Nevada</option>';
		code = code + '<option value="NH">New Hampshire</option>';
		code = code + '<option value="NJ">New Jersey</option>';
		code = code + '<option value="NM">New Mexico</option>';
		code = code + '<option value="NY">New York</option>';
		code = code + '<option value="NC">North Carolina</option>';
		code = code + '<option value="ND">North Dakota</option>';
		code = code + '<option value="OH">Ohio</option>';
		code = code + '<option value="OK">Oklahoma</option>';
		code = code + '<option value="OR">Oregon</option>';
		code = code + '<option value="PA">Pennsylvania</option>';
		code = code + '<option value="RI">Rhode Island</option>';
		code = code + '<option value="SC">South Carolina</option>';
		code = code + '<option value="SD">South Dakota</option>';
		code = code + '<option value="TN">Tennessee</option>';
		code = code + '<option value="TX">Texas</option>';
		code = code + '<option value="UT">Utah</option>';
		code = code + '<option value="VT">Vermont</option>';
		code = code + '<option value="VA">Virginia</option>';
		code = code + '<option value="WA">Washington</option>';
		code = code + '<option value="WV">West Virginia</option>';
		code = code + '<option value="WI">Wisconsin</option>';
		code = code + '<option value="WY">Wyoming</option>';

        code = code + '<'+ '/'+ 'select>';

     }
	else
	{
		code = '<input class=\''+className+'\'type=\'text\' size=\'36\' name="'+stateName+'" id="'+stateName+'" required="1" realname="'+replacedString+'">';


	}
	var span1 = spanLabel+"1";
	var span2 = spanLabel+"2";
	if(pwc=='GB')
	{
		document.getElementById(span1).innerHTML='County';
	}
	else
	{
		document.getElementById(span1).innerHTML='State / Province';
	}
	document.getElementById(span2).innerHTML=code;
}

function showSearchAffiliateState(countryName,stateName,spanLabel,replacedString,onchangeText,className)
{
    var code ='';
    var pwc=document.getElementById(countryName).value;

    if(!className)
    {
        className = '';
    }

    if(pwc=='US')
    {
        code ='<select class=\''+className+'\' name="'+stateName+'" id="'+stateName+'" '+onchangeText+'>';
        code = code + '<option value="">Select State</option>';
        code = code + '<option value="Al">Alabama</option>';
        code = code + '<option value="AK">Alaska</option>';
        code = code + '<option value="AZ">Arizona</option>';
        code = code + '<option value="AR">Arkansas</option>';
        code = code + '<option value="CA">California</option>';
        code = code + '<option value="CO">Colorado</option>';
        code = code + '<option value="CT">Connecticut</option>';
        code = code + '<option value="DC">District of Columbia</option>';
        code = code + '<option value="DE">Delaware</option>';
        code = code + '<option value="FL">Florida</option>';
        code = code + '<option value="GA">Georgia</option>';
        code = code + '<option value="GU">Guam</option>';
        code = code + '<option value="HI">Hawaii</option>';
        code = code + '<option value="ID">Idaho</option>';
        code = code + '<option value="IL">Illinois</option>';
        code = code + '<option value="IN">Indiana</option>';
        code = code + '<option value="IA">Iowa</option>';
        code = code + '<option value="KS">Kansas</option>';
        code = code + '<option value="KY">Kentucky</option>';
        code = code + '<option value="LA">Louisiana</option>';
        code = code + '<option value="ME">Maine</option>';
        code = code + '<option value="MD">Maryland</option>';
        code = code + '<option value="MA">Massachusetts</option>';
        code = code + '<option value="MI">Michigan</option>';
        code = code + '<option value="MN">Minnesota</option>';
        code = code + '<option value="MS">Mississippi</option>';
        code = code + '<option value="MO">Missouri</option>';
        code = code + '<option value="MT">Montana</option>';
        code = code + '<option value="NE">Nebraska</option>';
        code = code + '<option value="NV">Nevada</option>';
        code = code + '<option value="NH">New Hampshire</option>';
        code = code + '<option value="NJ">New Jersey</option>';
        code = code + '<option value="NM">New Mexico</option>';
        code = code + '<option value="NY">New York</option>';
        code = code + '<option value="NC">North Carolina</option>';
        code = code + '<option value="ND">North Dakota</option>';
        code = code + '<option value="OH">Ohio</option>';
        code = code + '<option value="OK">Oklahoma</option>';
        code = code + '<option value="OR">Oregon</option>';
        code = code + '<option value="PA">Pennsylvania</option>';
        code = code + '<option value="RI">Rhode Island</option>';
        code = code + '<option value="SC">South Carolina</option>';
        code = code + '<option value="SD">South Dakota</option>';
        code = code + '<option value="TN">Tennessee</option>';
        code = code + '<option value="TX">Texas</option>';
        code = code + '<option value="UT">Utah</option>';
        code = code + '<option value="VT">Vermont</option>';
        code = code + '<option value="VA">Virginia</option>';
        code = code + '<option value="WA">Washington</option>';
        code = code + '<option value="WV">West Virginia</option>';
        code = code + '<option value="WI">Wisconsin</option>';
        code = code + '<option value="WY">Wyoming</option>';

        code = code + '<'+ '/'+ 'select>';

     }
    else
    {
        code = '<input class=\''+className+'\'type=\'text\' size=\'36\' name="'+stateName+'" id="'+stateName+'" />';


    }
    var span1 = spanLabel+"1";
    var span2 = spanLabel+"2";
    if(pwc=='GB')
    {
        document.getElementById(span1).innerHTML='County';
    }
    else
    {
        document.getElementById(span1).innerHTML='State / Province';
    }
    document.getElementById(span2).innerHTML=code;
}


