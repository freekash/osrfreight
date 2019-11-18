<?php 
/**
 * @package EasyBook Add-Ons
 * @description A custom plugin for EasyBook - Hotel & Tour Booking WordPress Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date 03-10-2019
 * @version 1.1.7
 * @copyright Copyright ( C ) 2014 - 2019 cththemes.com . All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE
 */


$codes_text = "
Afghanistan	af
Albania	al
Algeria	dz
American Samoa	as
Andorra	ad
Angola	ao
Anguilla	ai
Antarctica	aq
Antigua and Barbuda	ag
Argentina	ar
Armenia	am
Aruba	aw
Australia	au
Austria	at
Azerbaijan	az
Bahamas	bs
Bahrain	bh
Bangladesh	bd
Barbados	bb
Belarus	by
Belgium	be
Belize	bz
Benin	bj
Bermuda	bm
Bhutan	bt
Bolivia	bo
Bosnia and Herzegovina	ba
Botswana	bw
Bouvet Island	bv
Brazil	br
British Indian Ocean Territory	io
Brunei Darussalam	bn
Bulgaria	bg
Burkina Faso	bf
Burundi	bi
Cambodia	kh
Cameroon	cm
Canada	ca
Cape Verde	cv
Cayman Islands	ky
Central African Republic	cf
Chad	td
Chile	cl
China	cn
Christmas Island	cx
Cocos (Keeling) Islands	cc
Colombia	co
Comoros	km
Congo	cg
Congo, the Democratic Republic of the	cd
Cook Islands	ck
Costa Rica	cr
Cote D'ivoire	ci
Croatia	hr
Cuba	cu
Cyprus	cy
Czech Republic	cz
Denmark	dk
Djibouti	dj
Dominica	dm
Dominican Republic	do
Ecuador	ec
Egypt	eg
El Salvador	sv
Equatorial Guinea	gq
Eritrea	er
Estonia	ee
Ethiopia	et
Falkland Islands (Malvinas)	fk
Faroe Islands	fo
Fiji	fj
Finland	fi
France	fr
French Guiana	gf
French Polynesia	pf
French Southern Territories	tf
Gabon	ga
Gambia	gm
Georgia	ge
Germany	de
Ghana	gh
Gibraltar	gi
Greece	gr
Greenland	gl
Grenada	gd
Guadeloupe	gp
Guam	gu
Guatemala	gt
Guinea	gn
Guinea-Bissau	gw
Guyana	gy
Haiti	ht
Heard Island and Mcdonald Islands	hm
Holy See (Vatican City State)	va
Honduras	hn
Hong Kong	hk
Hungary	hu
Iceland	is
India	in
Indonesia	id
Iran, Islamic Republic of	ir
Iraq	iq
Ireland	ie
Israel	il
Italy	it
Jamaica	jm
Japan	jp
Jordan	jo
Kazakhstan	kz
Kenya	ke
Kiribati	ki
Korea, Democratic People's Republic of	kp
Korea, Republic of	kr
Kuwait	kw
Kyrgyzstan	kg
Lao People's Democratic Republic	la
Latvia	lv
Lebanon	lb
Lesotho	ls
Liberia	lr
Libyan Arab Jamahiriya	ly
Liechtenstein	li
Lithuania	lt
Luxembourg	lu
Macao	mo
Macedonia, the Former Yugosalv Republic of	mk
Madagascar	mg
Malawi	mw
Malaysia	my
Maldives	mv
Mali	ml
Malta	mt
Marshall Islands	mh
Martinique	mq
Mauritania	mr
Mauritius	mu
Mayotte	yt
Mexico	mx
Micronesia, Federated States of	fm
Moldova, Republic of	md
Monaco	mc
Mongolia	mn
Montserrat	ms
Morocco	ma
Mozambique	mz
Myanmar	mm
Namibia	na
Nauru	nr
Nepal	np
Netherlands	nl
Netherlands Antilles	an
New Caledonia	nc
New Zealand	nz
Nicaragua	ni
Niger	ne
Nigeria	ng
Niue	nu
Norfolk Island	nf
Northern Mariana Islands	mp
Norway	no
Oman	om
Pakistan	pk
Palau	pw
Palestinian Territory, Occupied	ps
Panama	pa
Papua New Guinea	pg
Paraguay	py
Peru	pe
Philippines	ph
Pitcairn	pn
Poland	pl
Portugal	pt
Puerto Rico	pr
Qatar	qa
Reunion	re
Romania	ro
Russian Federation	ru
Rwanda	rw
Saint Helena	sh
Saint Kitts and Nevis	kn
Saint Lucia	lc
Saint Pierre and Miquelon	pm
Saint Vincent and the Grenadines	vc
Samoa	ws
San Marino	sm
Sao Tome and Principe	st
Saudi Arabia	sa
Senegal	sn
Serbia and Montenegro	cs
Seychelles	sc
Sierra Leone	sl
Singapore	sg
Slovakia	sk
Slovenia	si
Solomon Islands	sb
Somalia	so
South Africa	za
South Georgia and the South Sandwich Islands	gs
Spain	es
Sri Lanka	lk
Sudan	sd
Suriname	sr
Svalbard and Jan Mayen	sj
Swaziland	sz
Sweden	se
Switzerland	ch
Syrian Arab Republic	sy
Taiwan, Province of China	tw
Tajikistan	tj
Tanzania, United Republic of	tz
Thailand	th
Timor-Leste	tl
Togo	tg
Tokelau	tk
Tonga	to
Trinidad and Tobago	tt
Tunisia	tn
Turkey	tr
Turkmenistan	tm
Turks and Caicos Islands	tc
Tuvalu	tv
Uganda	ug
Ukraine	ua
United Arab Emirates	ae
United Kingdom	uk
United States	us
United States Minor Outlying Islands	um
Uruguay	uy
Uzbekistan	uz
Vanuatu	vu
Venezuela	ve
Viet Nam	vn
Virgin Islands, British	vg
Virgin Islands, U.S.	vi
Wallis and Futuna	wf
Western Sahara	eh
Yemen	ye
Zambia	zm
Zimbabwe	zw";

$codes_array = preg_split( '/\r\n|\r|\n/', strip_tags($codes_text) );//explode("\n", $content);
$codes_array = array_filter($codes_array);
// $returns = array();
$return = "<?php\n
/**
 * @package EasyBook Add-Ons
 * @description A custom plugin for EasyBook - Hotel & Tour Booking WordPress Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date 03-10-2019
 * @version 1.1.7
 * @copyright Copyright ( C ) 2014 - 2019 cththemes.com . All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE
 */

\n
\n
array(\n";
if(count($codes_array)){
	foreach ($codes_array as $country) {
		$country = trim($country);
		$country_parts = preg_split('/\s+/', $country);

		// $returns[] ="'{$country_parts[1]}' => __('".$country_parts[0]."', 'default'),";
		if(count($country_parts)>2){
			$return .="\t'{$country_parts[count($country_parts)-1]}' => __(\"";

			for ($i=0; $i < count($country_parts) -1; $i++) { 
				$return .= (($i == 0)? '' : ' ') . $country_parts[$i];
			}

			$return .="\", 'default'),\n";
		}else{
			$return .="\t'{$country_parts[1]}' => __(\"".$country_parts[0]."\", 'default'),\n";
		}
		
	}
}
$return .= ");\n";
// file_put_contents('code.txt', print_r($returns, true));
file_put_contents(ESB_ABSPATH.'inc/classes/Google/country-array.php', $return);

?>