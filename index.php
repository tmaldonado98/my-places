<?php     
include "connect.php";

if (isset($_POST['update'])) {
    foreach ($_POST['positions'] as $position) {
        $marker = $position[0];
        $newPosition = $position[1];
        $query = "UPDATE places_table SET position='$newPosition' WHERE marker='$marker'";
        mysqli_query($con, $query);
    }
    exit('success');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My List Of Places</title>
    <link rel="icon" href="./icons8-globe-32.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./media-queries.css">
    <link rel="stylesheet" href="./modal-magnific-popup/magnific-popup.css">
    <link href="./jquery-ui-1.13.2.custom/jquery-ui.css">
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> -->
    <script src="https://kit.fontawesome.com/602ec316c2.js" crossorigin="anonymous"></script>
    <link href='https://cdn.maptiler.com/maplibre-gl-js/v2.4.0/maplibre-gl.css' rel='stylesheet'/>
</head>
<body>
<!-- ,maximum-scale=1,user-scalable=no -->
<nav>
    <!-- <div id="contact" >
        <div class='nav-btns' title="Contact Me!" data-modal-target="contact-modal">Contact</div>

        <div id="contact-modal" class="active">
            <div id="contact-modal-title">
                <h3>Let's Get In Touch</h3>
                <button id="contact-close-btn" data-close-btn>&times;</button>
            </div>
            
            <div id="modal-body">
                <div class='nav-btns'><a href="https://github.com/tmaldonado98" target="_blank" rel="noopener noreferrer" title="My Github Profile"><i class="fa-brands fa-github fa-xl"></i></a></div>
                <div class='nav-btns'><a href="mailto:tmaldonadotrs@gmail.com" target="_blank" rel="noopener noreferrer" title="Send Me An Email!"><i class="fa-solid fa-envelope fa-xl"></i></a></div>
                <div class='nav-btns'><a href="https://www.linkedin.com/in/tom%C3%A1s-maldonado-9b396420a/" target="_blank" rel="noopener noreferrer" title="My LinkedIn Profile"><i class="fa-brands fa-linkedin fa-xl"></i></a></div>
                <div id="share" class='nav-btns'><p class="share" title="Share your list"><i class="fa-regular fa-xl fa-share-from-square share"></i> Share</p></div>

            </div>               
        </div>   
    </div>
    <div class="active" id="overlay"></div> -->
</nav>
<div id=container-print>
    <i class="fa-solid fa-print fa-xl print" title="Print Page"></i>
    <p class="print" title="Print Page">Print</p>
    <i class="fa-solid fa-question" title="To save as a PDF file click on 'Print' button, press on 'Destination' menu list, and select 'Save to PDF'."></i>
        
</div>

<section id="want">  

<h1>Where I Want To Go</h1>
<div id=container-table-btns>
    <div id=container-table>
        <table id=table>
            <tr id=heading-row>
                <th> </th>
                <th>Select All <input id=sel-all type=checkbox></th>
                <th>Country</th>
                <th>City</th>
                <th>Landmark</th>
                <th> </th>
            </tr>


<?php

$country = $_POST['country'];
$city = $_POST['city'];
$landmark = $_POST['landmark'];


        $result = array();
        if($data = mysqli_query($con, "SELECT * FROM places_table ORDER BY position")){
            while ($row = mysqli_fetch_assoc($data)) {
                $result[] = $row;
                $marker = $row['marker'];
                $position = $row['position'];
                $rcountry=ucwords($row['country']);
                $rcity=ucwords($row['city']);
                $rlandmark=ucwords($row['landmark']);
                $edit = 'edit';

echo "            
        <tr data-marker=$marker data-position=$position name=row class='data-row draggable ui-state-default ui-widget-content'  value=$marker>
            <div class=drag-container>
                <td id='handle'>
                    <svg viewBox='0 0 100 80' width='20' height='20' fill='black'>
                        <rect width='100' height='15' rx='8'></rect>
                        <rect y='30' width='100' height='15' rx='8'></rect>
                        <rect y='60' width='100' height='15' rx='8'></rect>
                    </svg>
                </td>
                
                <form id='cbox-form' action='delete.php' method='post'>
                <td class=check-td>
                    <input class=checkbox type=checkbox name=checkbox[] value=$marker>

                </td>

                <td id=country-text>" . ucwords($row['country']) . "</td>
                <td id=city-text>" . ucwords($row['city']) . "</td>
                <td id=landmark-text>" . ucwords($row['landmark']) . "</td>
                <td class=container-see-more><a href=#$marker name=see-more class='see-more open-popup-link popup-with-zoom-anim'  value=$marker editid=$marker>See More</a>
                </td>                
                
                <div id=$marker name=modal class='modal zoom-anim-dialog mfp-hide' value=$marker>
                    <div id=modal-title><b> <span id=m-landmark>" . ucwords($row['landmark'])."</span><span id=mlc>,</span> <span id=m-city>". ucwords($row['city'])."</span><span id=mcc>,</span> <span id=m-country>". ucwords($row['country'])."</span></b></div>
                    

                    <div id=container-search-engine>
                        <div class=search-engine>
                                                  
                        </div>
                    </div>
                    
                    <section id=section-edit>
                        <div id=container-ed-del>
                            <input type='button' name='edit' class=modal-edit value='Edit Place'></input>
                            <input type='button' dataId=$marker class=modal-delete name=modal_delete value='Remove Place'>
                        </div>
                            <div class='edit-field' name=edit_field>
                                <span class=inputs>
                                    <label for='country'><p>Country</p></label>
                                    <input class='ed-text' id='ed-country' placeholder='Country' type='text' autocomplete='off' name='editCountry' value=$rcountry>
                                    <label for='city'><p>City</p></label>
                                    <input class='ed-text' id='ed-city' placeholder='City' type='text' autocomplete='off' name='editCity' value=$rcity>
                                    <label for='landmark'><p>Landmark</p></label>
                                    <input class='ed-text' id='ed-landmark' placeholder='Landmark/Place' type='text' autocomplete='off' name='editLandmark' value=$rlandmark>
                                </span>
                                    <br>
                                <div class=update-btn>
                                   <input class=editBtn dataId=$marker type='button' value='Update'>
                                </div>
                            </div>
                    </section>

                    <div id=section-modal-map>
                        <div id=modal-map-container>
                            <div id=modal-map>
                        
                            </div>
                        </div>
                    </div>
                
                    <div id=container-section-facts>
                        <div id=facts>
                            <p>As of 2021</p>
                            <p id=fCountry><b>Country:</b> <span></span></p>
                            <p id=countryPop><b>Country Total Population:</b> <span></span> </p>
                            <p id=fCapital><b>Capital City:</b> <span></span></p>

                            <p id=fCity><b>Your City:</b> <span></span> </p>
                            <p id=cityPop><b>City Population:</b> <span></span> </p>
                            <p id=fLangs><b>Main Language(s) Spoken:</b> <span></span> </p>

                            <p id=fRel><b>National Religious Demographics (as of 2020):</b> <br><span></span> </p>
                            <p id=fEthnic><b>National Ethnic Demographics:</b> <span></span> </p>
                            <p id=fGdp><b>National Average GDP per Capita (in USD):</b> <span></span> </p>
                            <p id=fMigrants><b>% of Country Inhabitants International Migrants:</b> <br><span></span> </p>
                            <p id=fCurr><b>National Currency:</b> <span></span> </p>
                            
                            <h2 class=constr>**Site still under construction</h2>


                            <p>Sources: WorldBank, </p>                          

                        </div>

                        <div class=flag-container>
                            <div id=flag>
                                flag goes here
                            </div>

                            <div id=weather>
                                weather api here?
                            </div>

                        </div>

                    </div>

                    <div id=container-news>
                        <div id=news>
                            'news' cse section here
                        </div>
                    </div>

                    <div id=container-people-of>
                        <div id=people-of>
                            'people of' cse section here
                            
                        </div>
                    </div>


                </div>

            </div class=drag-container>   
        </tr>

                        ";
                    }
                }
        if (isset($_POST['id'])) {
            $markerid = $_POST['id'];
            $edcountry = $_POST['edCountry'];
            $edcity = $_POST['edCity'];
            $edlandmark = $_POST['edLandmark'];

            $exec = mysqli_query($con, "UPDATE `places_table` SET `country` = '".$edcountry."', `city` = '".$edcity."', `landmark` = '".$edlandmark."' WHERE `marker` = '".$markerid."'");
    
            // if (!$con->query($exec)) {
            //     echo "query failed: (" . $con->errno . ") " . $con->error;
            //     }
        } 

echo "    </table>
</div>"; 

$select = ("SELECT * FROM places_table");
$count = mysqli_query($con, $select);
$rowcount = mysqli_num_rows($count);
echo "<p id=total-places ><b>Total Number Of Places: " . $rowcount . "</b></p>";

?>
       
       <ul>
           <li>Click on <b>'See More'</b> section to learn about your place!</li>
           <li>Edit or delete a place in the <b>'See More'</b> section</li>
           <li>Be sure to contribute to the list!</li>
           <!-- <li>To avoid error, make sure to remove empty spaces at the </li> -->
       </ul>

       <h2 class="constr">**Site still under construction</h2>
            <div id="btn-msg">
            <div id="btn">
                        <input type="button" class="del-sel" name="delete_sel" value="Delete Selection">
                        
                    </form>
            </div>    
        
</div id=container-table-btns>

    </div>

        
        <div id="container-add-place">
            <div id="head-text">
                <h3 id="med-head">Add A New Place</h3>
                <div id="add-place">
                    <div class="container-input">
                        <span>(Recommended)</span>
                        <label for="country"><p>Country</p></label>
                        <input list="countryList" autofocus autocomplete='off' class="text" id="country" placeholder="Country" type="text" name="country"></input>
                        <datalist id="countryList">
                            <option value="Aruba"></option>
                            <option value="Afghanistan"></option>
                            <option value="Angola"></option>
                            <option value="Anguilla"></option>
                            <option value="Ã…land Islands"></option>
                            <option value="Albania"></option>
                            <option value="Andorra"></option>
                            <option value="United Arab Emirates"></option>
                            <option value="Argentina"></option>
                            <option value="Armenia"></option>
                            <option value="American Samoa"></option>
                            <option value="Antarctica"></option>
                            <option value="French Southern and Antarctic Lands"></option>
                            <option value="Antigua and Barbuda"></option>
                            <option value="Australia"></option>
                            <option value="Austria"></option>
                            <option value="Azerbaijan"></option>
                            <option value="Burundi"></option>
                            <option value="Belgium"></option>
                            <option value="Benin"></option>
                            <option value="Burkina Faso"></option>
                            <option value="Bangladesh"></option>
                            <option value="Bulgaria"></option>
                            <option value="Bahrain"></option>
                            <option value="Bahamas"></option>
                            <option value="Bosnia and Herzegovina"></option>
                            <option value="Saint BarthÃ©lemy"></option>
                            <option value="Saint Helena"></option>
                            <option value="Belarus"></option>
                            <option value="Belize"></option>
                            <option value="Bermuda"></option>
                            <option value="Bolivia"></option>
                            <option value="Caribbean Netherlands"></option>
                            <option value="Brazil"></option>
                            <option value="Barbados"></option>
                            <option value="Brunei"></option>
                            <option value="Bhutan"></option>
                            <option value="Bouvet Island"></option>
                            <option value="Botswana"></option>
                            <option value="Central African Republic"></option>
                            <option value="Canada"></option>
                            <option value="Cocos (Keeling) Islands"></option>
                            <option value="Switzerland"></option>
                            <option value="Chile"></option>
                            <option value="China"></option>
                            <option value="Ivory Coast"></option>
                            <option value="Cameroon"></option>
                            <option value="DR Congo"></option>
                            <option value="Republic of the Congo"></option>
                            <option value="Cook Islands"></option>
                            <option value="Colombia"></option>
                            <option value="Comoros"></option>
                            <option value="Cape Verde"></option>
                            <option value="Costa Rica"></option>
                            <option value="Cuba"></option>
                            <option value="CuraÃ§ao"></option>
                            <option value="Christmas Island"></option>
                            <option value="Cayman Islands"></option>
                            <option value="Cyprus"></option>
                            <option value="Czechia"></option>
                            <option value="Germany"></option>
                            <option value="Djibouti"></option>
                            <option value="Dominica"></option>
                            <option value="Denmark"></option>
                            <option value="Dominican Republic"></option>
                            <option value="Algeria"></option>
                            <option value="Ecuador"></option>
                            <option value="Egypt"></option>
                            <option value="Eritrea"></option>
                            <option value="Western Sahara"></option>
                            <option value="Spain"></option>
                            <option value="Estonia"></option>
                            <option value="Ethiopia"></option>
                            <option value="Finland"></option>
                            <option value="Fiji"></option>
                            <option value="Falkland Islands"></option>
                            <option value="France"></option>
                            <option value="Faroe Islands"></option>
                            <option value="Micronesia"></option>
                            <option value="Gabon"></option>
                            <option value="United Kingdom"></option>
                            <option value="Georgia"></option>
                            <option value="Guernsey"></option>
                            <option value="Ghana"></option>
                            <option value="Gibraltar"></option>
                            <option value="Guinea"></option>
                            <option value="Guadeloupe"></option>
                            <option value="Gambia"></option>
                            <option value="Guinea-Bissau"></option>
                            <option value="Equatorial Guinea"></option>
                            <option value="Greece"></option>
                            <option value="Grenada"></option>
                            <option value="Greenland"></option>
                            <option value="Guatemala"></option>
                            <option value="French Guiana"></option>
                            <option value="Guam"></option>
                            <option value="Guyana"></option>
                            <option value="Hong Kong"></option>
                            <option value="Heard Island and McDonald Islands"></option>
                            <option value="Honduras"></option>
                            <option value="Croatia"></option>
                            <option value="Haiti"></option>
                            <option value="Hungary"></option>
                            <option value="Indonesia"></option>
                            <option value="Isle of Man"></option>
                            <option value="India"></option>
                            <option value="British Indian Ocean Territory"></option>
                            <option value="Ireland"></option>
                            <option value="Iran"></option>
                            <option value="Iraq"></option>
                            <option value="Iceland"></option>
                            <option value="Israel"></option>
                            <option value="Italy"></option>
                            <option value="Jamaica"></option>
                            <option value="Jersey"></option>
                            <option value="Jordan"></option>
                            <option value="Japan"></option>
                            <option value="Kazakhstan"></option>
                            <option value="Kenya"></option>
                            <option value="Kyrgyzstan"></option>
                            <option value="Cambodia"></option>
                            <option value="Kiribati"></option>
                            <option value="Saint Kitts and Nevis"></option>
                            <option value="South Korea"></option>
                            <option value="Kosovo"></option>
                            <option value="Kuwait"></option>
                            <option value="Laos"></option>
                            <option value="Lebanon"></option>
                            <option value="Liberia"></option>
                            <option value="Libya"></option>
                            <option value="Saint Lucia"></option>
                            <option value="Liechtenstein"></option>
                            <option value="Sri Lanka"></option>
                            <option value="Lesotho"></option>
                            <option value="Lithuania"></option>
                            <option value="Luxembourg"></option>
                            <option value="Latvia"></option>
                            <option value="Macau"></option>
                            <option value="Saint Martin"></option>
                            <option value="Morocco"></option>
                            <option value="Monaco"></option>
                            <option value="Moldova"></option>
                            <option value="Madagascar"></option>
                            <option value="Maldives"></option>
                            <option value="Mexico"></option>
                            <option value="Marshall Islands"></option>
                            <option value="North Macedonia"></option>
                            <option value="Mali"></option>
                            <option value="Malta"></option>
                            <option value="Myanmar"></option>
                            <option value="Montenegro"></option>
                            <option value="Mongolia"></option>
                            <option value="Northern Mariana Islands"></option>
                            <option value="Mozambique"></option>
                            <option value="Mauritania"></option>
                            <option value="Montserrat"></option>
                            <option value="Martinique"></option>
                            <option value="Mauritius"></option>
                            <option value="Malawi"></option>
                            <option value="Malaysia"></option>
                            <option value="Mayotte"></option>
                            <option value="Namibia"></option>
                            <option value="New Caledonia"></option>
                            <option value="Niger"></option>
                            <option value="Norfolk Island"></option>
                            <option value="Nigeria"></option>
                            <option value="Nicaragua"></option>
                            <option value="Niue"></option>
                            <option value="Netherlands"></option>
                            <option value="Norway"></option>
                            <option value="Nepal"></option>
                            <option value="Nauru"></option>
                            <option value="New Zealand"></option>
                            <option value="Oman"></option>
                            <option value="Pakistan"></option>
                            <option value="Panama"></option>
                            <option value="Pitcairn Islands"></option>
                            <option value="Peru"></option>
                            <option value="Philippines"></option>
                            <option value="Palau"></option>
                            <option value="Papua New Guinea"></option>
                            <option value="Poland"></option>
                            <option value="Puerto Rico"></option>
                            <option value="North Korea"></option>
                            <option value="Portugal"></option>
                            <option value="Paraguay"></option>
                            <option value="Palestine"></option>
                            <option value="French Polynesia"></option>
                            <option value="Qatar"></option>
                            <option value="RÃ©union"></option>
                            <option value="Romania"></option>
                            <option value="Russia"></option>
                            <option value="Rwanda"></option>
                            <option value="Saudi Arabia"></option>
                            <option value="Sudan"></option>
                            <option value="Senegal"></option>
                            <option value="Singapore"></option>
                            <option value="South Georgia"></option>
                            <option value="Svalbard and Jan Mayen"></option>
                            <option value="Solomon Islands"></option>
                            <option value="Sierra Leone"></option>
                            <option value="El Salvador"></option>
                            <option value="San Marino"></option>
                            <option value="Somalia"></option>
                            <option value="Saint Pierre and Miquelon"></option>
                            <option value="Serbia"></option>
                            <option value="South Sudan"></option>
                            <option value="SÃ£o TomÃ© and PrÃ­ncipe"></option>
                            <option value="Suriname"></option>
                            <option value="Slovakia"></option>
                            <option value="Slovenia"></option>
                            <option value="Sweden"></option>
                            <option value="Eswatini"></option>
                            <option value="Sint Maarten"></option>
                            <option value="Seychelles"></option>
                            <option value="Syria"></option>
                            <option value="Turks and Caicos Islands"></option>
                            <option value="Chad"></option>
                            <option value="Togo"></option>
                            <option value="Thailand"></option>
                            <option value="Tajikistan"></option>
                            <option value="Tokelau"></option>
                            <option value="Turkmenistan"></option>
                            <option value="Timor-Leste"></option>
                            <option value="Tonga"></option>
                            <option value="Trinidad and Tobago"></option>
                            <option value="Tunisia"></option>
                            <option value="Turkey"></option>
                            <option value="Tuvalu"></option>
                            <option value="Taiwan"></option>
                            <option value="Tanzania"></option>
                            <option value="Uganda"></option>
                            <option value="Ukraine"></option>
                            <option value="United States Minor Outlying Island"></option>s
                            <option value="Uruguay"></option>
                            <option value="United States"></option>
                            <option value="Uzbekistan"></option>
                            <option value="Vatican City"></option>
                            <option value="Saint Vincent and the Grenadines"></option>
                            <option value="Venezuela"></option>
                            <option value="British Virgin Islands"></option>
                            <option value="United States Virgin Islands"></option>
                            <option value="Vietnam"></option>
                            <option value="Vanuatu"></option>
                            <option value="Wallis and Futuna"></option>
                            <option value="Samoa"></option>
                            <option value="Yemen"></option>
                            <option value="South Africa"></option>
                            <option value="Zambia"></option>
                            <option value="Zimbabwe"></option>
                        </datalist>
                    </div>
                    <div class="container-input">
                        <span> (Recommended) </span>
                        <label for="city"><p>City</p></label>
                        <input autocomplete='off' list="cityList" class="text" id="city" placeholder="City" type="text" name="city" ></input>
                        <datalist id="cityList">
                            <option value="Oranjestad"></option>
                            <option value="Kabul"></option>
                            <option value="Luanda"></option>
                            <option value="The Valley"></option>
                            <option value="Mariehamn"></option>
                            <option value="Tirana"></option>
                            <option value="Andorra la Vella"></option>
                            <option value="Abu Dhabi"></option>
                            <option value="Buenos Aires"></option>
                            <option value="Yerevan"></option>
                            <option value="Pago Pago"></option>
                            <option value="Port-aux-FranÃ§ais"></option>
                            <option value="Saint John's"></option>
                            <option value="Canberra"></option>
                            <option value="Vienna"></option>
                            <option value="Baku"></option>
                            <option value="Gitega"></option>
                            <option value="Brussels"></option>
                            <option value="Porto-Novo"></option>
                            <option value="Ouagadougou"></option>
                            <option value="Dhaka"></option>
                            <option value="Sofia"></option>
                            <option value="Manama"></option>
                            <option value="Nassau"></option>
                            <option value="Sarajevo"></option>
                            <option value="Gustavia"></option>
                            <option value="Jamestown"></option>
                            <option value="Minsk"></option>
                            <option value="Belmopan"></option>
                            <option value="Hamilton"></option>
                            <option value="Sucre"></option>
                            <option value="Kralendijk"></option>
                            <option value="BrasÃ­lia"></option>
                            <option value="Bridgetown"></option>
                            <option value="Bandar Seri Begawan"></option>
                            <option value="Thimphu"></option>
                            <option value="Gaborone"></option>
                            <option value="Bangui"></option>
                            <option value="Ottawa"></option>
                            <option value="West Island"></option>
                            <option value="Bern"></option>
                            <option value="Santiago"></option>
                            <option value="Beijing"></option>
                            <option value="Yamoussoukro"></option>
                            <option value="YaoundÃ©"></option>
                            <option value="Kinshasa"></option>
                            <option value="Brazzaville"></option>
                            <option value="Avarua"></option>
                            <option value="BogotÃ¡"></option>
                            <option value="Moroni"></option>
                            <option value="Praia"></option>
                            <option value="San JosÃ©"></option>
                            <option value="Havana"></option>
                            <option value="Willemstad"></option>
                            <option value="Flying Fish Cove"></option>
                            <option value="George Town"></option>
                            <option value="Nicosia"></option>
                            <option value="Prague"></option>
                            <option value="Berlin"></option>
                            <option value="Djibouti"></option>
                            <option value="Roseau"></option>
                            <option value="Copenhagen"></option>
                            <option value="Santo Domingo"></option>
                            <option value="Algiers"></option>
                            <option value="Quito"></option>
                            <option value="Cairo"></option>
                            <option value="Asmara"></option>
                            <option value="El AaiÃºn"></option>
                            <option value="Madrid"></option>
                            <option value="Tallinn"></option>
                            <option value="Addis Ababa"></option>
                            <option value="Helsinki"></option>
                            <option value="Suva"></option>
                            <option value="Stanley"></option>
                            <option value="Paris"></option>
                            <option value="TÃ³rshavn"></option>
                            <option value="Palikir"></option>
                            <option value="Libreville"></option>
                            <option value="London"></option>
                            <option value="Tbilisi"></option>
                            <option value="St. Peter Port"></option>
                            <option value="Accra"></option>
                            <option value="Gibraltar"></option>
                            <option value="Conakry"></option>
                            <option value="Basse-Terre"></option>
                            <option value="Banjul"></option>
                            <option value="Bissau"></option>
                            <option value="Malabo"></option>
                            <option value="Athens"></option>
                            <option value="St. George's"></option>
                            <option value="Nuuk"></option>
                            <option value="Guatemala City"></option>
                            <option value="Cayenne"></option>
                            <option value="HagÃ¥tÃ±a"></option>
                            <option value="Georgetown"></option>
                            <option value="City of Victoria"></option>
                            <option value="Tegucigalpa"></option>
                            <option value="Zagreb"></option>
                            <option value="Port-au-Prince"></option>
                            <option value="Budapest"></option>
                            <option value="Jakarta"></option>
                            <option value="Douglas"></option>
                            <option value="New Delhi"></option>
                            <option value="Diego Garcia"></option>
                            <option value="Dublin"></option>
                            <option value="Tehran"></option>
                            <option value="Baghdad"></option>
                            <option value="Reykjavik"></option>
                            <option value="Jerusalem"></option>
                            <option value="Rome"></option>
                            <option value="Kingston"></option>
                            <option value="Saint Helier"></option>
                            <option value="Amman"></option>
                            <option value="Tokyo"></option>
                            <option value="Nur-Sultan"></option>
                            <option value="Nairobi"></option>
                            <option value="Bishkek"></option>
                            <option value="Phnom Penh"></option>
                            <option value="South Tarawa"></option>
                            <option value="Basseterre"></option>
                            <option value="Seoul"></option>
                            <option value="Pristina"></option>
                            <option value="Kuwait City"></option>
                            <option value="Vientiane"></option>
                            <option value="Beirut"></option>
                            <option value="Monrovia"></option>
                            <option value="Tripoli"></option>
                            <option value="Castries"></option>
                            <option value="Vaduz"></option>
                            <option value="Colombo"></option>
                            <option value="Maseru"></option>
                            <option value="Vilnius"></option>
                            <option value="Luxembourg"></option>
                            <option value="Riga"></option>
                            <option value="Marigot"></option>
                            <option value="Rabat"></option>
                            <option value="Monaco"></option>
                            <option value="ChiÈ™inÄƒu"></option>
                            <option value="Antananarivo"></option>
                            <option value="MalÃ©"></option>
                            <option value="Mexico City"></option>
                            <option value="Majuro"></option>
                            <option value="Skopje"></option>
                            <option value="Bamako"></option>
                            <option value="Valletta"></option>
                            <option value="Naypyidaw"></option>
                            <option value="Podgorica"></option>
                            <option value="Ulan Bator"></option>
                            <option value="Saipan"></option>
                            <option value="Maputo"></option>
                            <option value="Nouakchott"></option>
                            <option value="Plymouth"></option>
                            <option value="Fort-de-France"></option>
                            <option value="Port Louis"></option>
                            <option value="Lilongwe"></option>
                            <option value="Kuala Lumpur"></option>
                            <option value="Mamoudzou"></option>
                            <option value="Windhoek"></option>
                            <option value="NoumÃ©a"></option>
                            <option value="Niamey"></option>
                            <option value="Kingston"></option>
                            <option value="Abuja"></option>
                            <option value="Managua"></option>
                            <option value="Alofi"></option>
                            <option value="Amsterdam"></option>
                            <option value="Oslo"></option>
                            <option value="Kathmandu"></option>
                            <option value="Yaren"></option>
                            <option value="Wellington"></option>
                            <option value="Muscat"></option>
                            <option value="Islamabad"></option>
                            <option value="Panama City"></option>
                            <option value="Adamstown"></option>
                            <option value="Lima"></option>
                            <option value="Manila"></option>
                            <option value="Ngerulmud"></option>
                            <option value="Port Moresby"></option>
                            <option value="Warsaw"></option>
                            <option value="San Juan"></option>
                            <option value="Pyongyang"></option>
                            <option value="Lisbon"></option>
                            <option value="AsunciÃ³n"></option>
                            <option value="Ramallah"></option>
                            <option value="PapeetÄ“"></option>
                            <option value="Doha"></option>
                            <option value="Saint-Denis"></option>
                            <option value="Bucharest"></option>
                            <option value="Moscow"></option>
                            <option value="Kigali"></option>
                            <option value="Riyadh"></option>
                            <option value="Khartoum"></option>
                            <option value="Dakar"></option>
                            <option value="Singapore"></option>
                            <option value="King Edward Point"></option>
                            <option value="Longyearbyen"></option>
                            <option value="Honiara"></option>
                            <option value="Freetown"></option>
                            <option value="San Salvador"></option>
                            <option value="City of San Marino"></option>
                            <option value="Mogadishu"></option>
                            <option value="Saint-Pierre"></option>
                            <option value="Belgrade"></option>
                            <option value="Juba"></option>
                            <option value="SÃ£o TomÃ©"></option>
                            <option value="Paramaribo"></option>
                            <option value="Bratislava"></option>
                            <option value="Ljubljana"></option>
                            <option value="Stockholm"></option>
                            <option value="Lobamba"></option>
                            <option value="Philipsburg"></option>
                            <option value="Victoria"></option>
                            <option value="Damascus"></option>
                            <option value="Cockburn Town"></option>
                            <option value="N'Djamena"></option>
                            <option value="LomÃ©"></option>
                            <option value="Bangkok"></option>
                            <option value="Dushanbe"></option>
                            <option value="Fakaofo"></option>
                            <option value="Ashgabat"></option>
                            <option value="Dili"></option>
                            <option value="Nuku'alofa"></option>
                            <option value="Port of Spain"></option>
                            <option value="Tunis"></option>
                            <option value="Ankara"></option>
                            <option value="Funafuti"></option>
                            <option value="Taipei"></option>
                            <option value="Dodoma"></option>
                            <option value="Kampala"></option>
                            <option value="Kyiv"></option>
                            <option value="Montevideo"></option>
                            <option value="Washington D.C."></option>
                            <option value="Tashkent"></option>
                            <option value="Vatican City"></option>
                            <option value="Kingstown"></option>
                            <option value="Caracas"></option>
                            <option value="Road Town"></option>
                            <option value="Charlotte Amalie"></option>
                            <option value="Hanoi"></option>
                            <option value="Port Vila"></option>
                            <option value="Mata-Utu"></option>
                            <option value="Apia"></option>
                            <option value="Sana'a"></option>
                            <option value="Pretoria"></option>
                            <option value="Lusaka"></option>
                            <option value="Harare"></option>
                        </datalist>
                    </div>
                    <div class="container-input">
                        <span> (Recommended) </span>
                        <label for="landmark"><p>Landmark/Place</p></label>
                        <input autocomplete='off' class="text" id="landmark" placeholder="Landmark/Place" type="text" name="landmark"></input>
                    </div>
                </div>

                    <div id="container-insertBtn">
                        <input id="insertBtn" type="button" value="Add New Place"></input>
                    </div>
            </div>
        </div>

</div>
</section>

<section id="map-section">
    
    <div id="map-container">
        <div><h2>Your Map</h2></div>
            <div id="map" class="border-w-bg">
    
            </div>
        <br>
            <p>To see the <u>updated map</u> please refresh the page after editing the list.</p>
            
        
        
    </div>
    
</section>

<footer>
    <p>
        Tomas Maldonado 2022
    </p>

</footer>

<?php
mysqli_close($con);
?>
    <script defer src="https://code.jquery.com/jquery-3.6.1.js"></script>

    <script defer type="module" src="script.js"></script>

    <!-- <script defer src='map-script.js'></script> -->

        <!-- jQuery UI plugin -->
    <script defer src="jquery-ui.js"></script>

    <!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->

    
    <script defer src="sortable-script.js"></script>

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    
        
    <script src='https://cdn.maptiler.com/maplibre-gl-js/v2.4.0/maplibre-gl.js'></script>
    
</body>
</html>