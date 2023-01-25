$(document).ready(()=>{
    $(window).scrollTop(0);

    // window.scrollTo(0, 0);
    /*
    const openModalBtns = $('data-modal-target');
    const closeModalBtns = $('data-close-btn');
    const overlay = $('#overlay');

    $('data-modal-target').on('click', () => {
        let modal = $('data-modal-target');
        function openModal(modal){

        }
    });

    function openModal(modal){
        if(modal == null){
            return false
        } else {
            modal.addClass('active');
            overlay.addClass('active');
        }
    }

    function closeModal(modal){
        if(modal == null){
            return false
        } else {
            modal.removeClass('active');
            overlay.removeClass('active');
        }
    }
*/
// $('tbody').sortable({
//     handle: '#handle',
//     items: 'tr:not(#heading-row)',
//     // distance: 20,
//     refresh: 'true',

//     update: function (event, ui){
//         $(this).not('#heading-row').children().each(function (marker){
//             if ($(this).attr('data-position') != (marker+1)) {
//                 $(this).attr('data-position', (marker+1)).addClass('updated')
//             }
//             saveNewPositions();
//         })
//     }
// });


$('#insertBtn').click(()=>{
    if ($('#country').val() == '' && $('#city').val() == '' && $('#landmark').val() == '') {
        return false
    }
});
    ///replaced SUBMIT with CLICK event 


$('body').on('keypress', '.text', function(e){
    if (e.keyCode === 13) {    
        let insert = 'insert';
        let data = {
            action: insert,
            country: $('#country').val().trim(),
            city: $('#city').val().trim(),
            landmark: $('#landmark').val().trim(),  
        };

        $.ajax({
            url: 'insert.php',
            type: 'POST',
            data: data,
            success: function (){
               displayData();           
            }
        })
    }
//This block enables form to be posted upon pressing ENTER key.
// Not submitted, but posted with AJAX
});


////THIS EVENT CAPITALIZES FIRST LETTER OF EACH WORD IN EACH INPUT FIELD
/// AND INVALIDATES NUMBER KEYS. IT DOES NOT CAPITALIZE EACH FIRST LETTER FOR DB ENTRIES
// IT ALSO ALLOWS FOR COMMAS, PERIODS, SHIFT AND CAPS BUTTONS.

$('body').on('keypress', 'input', function(e){
    $('.text').attr('style', 'text-transform:capitalize');
    $('.ed-text').attr('style', 'text-transform:capitalize');
    
    if (e.keyCode > 47 && e.keyCode < 65 && e.keyCode != 32) {
        return false;
    }
});

let countrySuggestion = [];
/*
$.getJSON("countriesonly.json", function(result){
    $.each(result.countriesonly, function(val){
        // $('#country').keyup(()=>{
            countrySuggestion.push(result.countriesonly);
            // if (str.substring == this.name["common"].substring) {
            //     $('#countryList').append('<option></option>').val(this.name["common"])
            //     console.log('test');
            // }
            // });
        })
    })
    $("#country" ).autocomplete({
        source: countrySuggestion
      });
*/

///THESE THREE KEYPRESS EVENTS INVALIDATE CHARACTERS WHEN FIELDS REACH A CHARACTER
/// COUNT OF 20.
$('#country').keypress(()=>{
    if ($('#country').val().length >= 25) {
        return false;
    };
});

$('#city').keypress(()=>{
    if ($('#city').val().length >= 25) {
        return false;
    };
});
$('#landmark').keypress(()=>{
    if ($('#landmark').val().length >= 25) {
        return false;
    };
});

$('body').on('keypress', '#ed-country', function(){
    if ($('#ed-country').val().length >= 25) {
        return false;
    };
});

$('body').on('keypress', '#ed-city', function(){
    if ($('#ed-city').val().length >= 25) {
        return false;
    };
});

$('body').on('keypress', '#ed-landmark', function(){
    if ($('#ed-landmark').val().length >= 25) {
        return false;
    };
});

////MAKES ADD ROW BUTTON APPEAR UPON ENTERING A LETTER VALUE IN ANY OF
// THE THREE TEXT FIELDS. THIS IS DONE IN ORDER TO AVOID ADDING EMPTY ROWS INTO DB
$('.text').keyup((e)=>{
    if ($('#country').val().length > 0 || $('#city').val().length > 0 || $('#landmark').val().length > 0) {
        $('#insertBtn').attr('style', 'opacity:1');
    } else {
        $('#insertBtn').attr('style', 'opacity:0'); 
    };
});


$('.print').click(()=>{
    print();    
});

$('.share').click(()=>{
    if (navigator.share) {
        navigator.share({
            url: 'https://myplaces.rf.gd/',
            title: 'My List Of Places'
            
        })
    }
});

////THE FIRST BLOCK OF CODE SELECTS ALL BOXES WHEN SELECT ALL BTN IS CHECKED
///SECOND BLOCK MAKES THE CHECKED STATUS OF THE SELECT ALL BTN CONGRUENT W/ OTHER BTNS

$('body').on('click', '#sel-all', function () {
        $('input[type=checkbox]').prop("checked", $('#sel-all').prop("checked"));
}); //works


$('body').on('change', '.checkbox', function(){
    if ($('checkbox').prop("checked", false)) {
        $('#sel-all').prop("checked", false)
    };
    
    if ($('.checkbox:checked').length == $('.checkbox').length) {
        $('#sel-all').prop("checked", true)
    }
});//works

$('body').on('click focus blur', '.checkbox', function(){
    
    if ($('.checkbox:checked').length > 0) {
        $('.del-sel').addClass('del-sel-visible');

    } else if ($('.checkbox:checked').length == 0) {
        $('.del-sel').removeClass('del-sel-visible');
        
    }
});

$('body').on('click', '#sel-all', function(){
    if ($('#sel-all:checked') && $('.checkbox:checked').length == $('.checkbox').length) {
        $('.del-sel').addClass('del-sel-visible');
    } 
    else if ($('#sel-all').attr('checked', false)) {
        $('.del-sel').removeClass('del-sel-visible');        
    } 
});


$('body').on('focus blur', '.checkbox', function(){
    let rows = $('.data-row');
    let checkbox = $('.checkbox');
    
    for (let i = 0; i < rows.length; i++) {

     $(checkbox[i]).change(()=>{
         if ($(checkbox[i]).attr('checked', true)) {
             $($(rows[i]).children('td')).toggleClass('selectedRow')
         }
         else if ($(checkbox[i]).attr('checked', false)) {
             $($(rows[i]).children('td')).toggleClass('selectedRow')
         }
         
     });
 }
});

$('body').on('change', '#sel-all', function (e) {
 if ($('#sel-all').attr('checked', true)) {
     $('.data-row').children('td').addClass('selectedRow')
 }
 if ($('#sel-all').attr('checked', false) && $('.checkbox:checked').length == 0) {
     $('.data-row').children('td').removeClass('selectedRow')
 }
});


///Suggestions function
/*
function countrySuggestion(str){
    
    if (str.length == 0) {
        $('#country-sug').val('')
    } else {
        $.ajax({
            method: 'GET',
            url: 'suggest.php?q=+str',
            dataType: 'php',
            success: function(result) {
                $('#country-sug').html(this.result)
            }
        }).done(function (data) {
            console.log(data);
        });
    }
}

$('#country').keyup(countrySuggestion(str), {
    
});

$('#city').keyup(citySuggestion(str), {
    //
});

*/


// if ($.magnificPopup.close()){
//     $('.edit-field').removeClass('edit-field-visible');

//     window.history.replaceState(null, null, "?q=");
//     $('head').find('script[src="https://cse.google.com/cse.js?cx=22bdf86666de74d21"]').remove();
//     $('head').find('script[src="https://www.google.com/cse/static/element/f275a300093f201a/cse_element__en.js?usqp=CAI%3D"]').remove();
//     $('.search-engine').find('.gsc-control-cse').remove(); 
// };


    
//AJAX INSERT
$('body').on('click', '#insertBtn', function (){

    let insert = 'insert';
    let data = {
        action: insert,
        country: $('#country').val().trim(),
        city: $('#city').val().trim(),
        landmark: $('#landmark').val().trim(),  
        
    };
        
    $.ajax({
        url: 'insert.php',
        type: 'POST',
        data: data,
        success: function (){
           displayData();           
        }
    })
});



//     //AJAX DISPLAY DB DATA
//     function displayData(){
//         $.ajax({        
//             type: 'GET',
//             url: 'data.php',
//             dataType: 'text',
//             success: function(result){
//                 let loadedData = $('#container-table-btns').html(result);
//                 loadedData;

//                 loadedData.find('tbody').sortable({
//                     ///disables sortable for heading row
//                     items: 'tr:not(#heading-row)',
//                     // distance: 20,
//                     refresh: 'true',
            
//                     update: function (event, ui){
//                         $(this).not('#heading-row').children().each(function (marker){
//                             if ($(this).attr('data-position') != (marker+1)) {
//                                 $(this).attr('data-position', (marker+1)).addClass('updated')
//                             }
//                             saveNewPositions();
//                         })
//                     }
            
//                 });
//                 $('#country').val('');
//                 $('#city').val('');
//                 $('#landmark').val('');
//                 $('#insertBtn').attr('style', 'opacity:0');

//             }
//     });
// };

function saveNewPositions(){
    let positions = [];
    $('.updated').each(function (){
        positions.push([$(this).attr('data-marker'), $(this).attr('data-position')]);
        $(this).removeClass('updated');
    });

    $.ajax({
        url: 'index.php',
        method: 'POST',
        dataType: 'text',
        data: {
            update: 1,
            positions: positions
        }
    });   
}


// AJAX DELETE
$('body').on('click', '.del-sel', function(){
        let id = [];
        let confirmalert = confirm('Are you sure?');
        
        if (confirmalert == true) {
            
            $('body').find('.checkbox:checked').each(function (i){
                id[i] = $(this).val();
            });

            $.ajax({
                method: 'POST',
                url: 'delete.php',
                data: {
                id:id,
                },
                success: function () {
                    console.log('deleted');
                    displayData();
                }
            })
            
        }
});

$('body').on('click', '.modal-delete', function(){

    let confirmalert = confirm('Are you sure?');
    let rowData = $(this).attr('dataId');

    if (confirmalert == true) {

        console.log(rowData)
        
        $.ajax({
            method: 'POST',
            url: 'delete-modal.php',
            data: {rowData: rowData},
            success: function(){
                console.log('row deleted from modal');
                $.magnificPopup.close();
                displayData();
            }
        })
    }
    
    
    // }
});


///AJAX EDIT ROW

$('body').on('click', '.editBtn', function (){

    $.ajax({
        method: 'POST',
        data: {
            // action: 'edit',
            id: $('.editBtn').attr('dataId'),
            edCountry: $('#ed-country').val().trim(),
            edCity: $('#ed-city').val().trim(),
            edLandmark: $('#ed-landmark').val().trim()
        },
        dataType: 'html',
        success: function (){
            console.log('edit ajax posted');
            displayData()           
            $.magnificPopup.close();
        }
    })
});

//send update query upon enter key press
$('body').on('keypress', '.ed-text', function(e){
    if (e.keyCode === 13) {    
        $.ajax({
            method: 'POST',
            data: {
                id: $('.editBtn').attr('dataId'),
                edCountry: $('#ed-country').val().trim(),
                edCity: $('#ed-city').val().trim(),
                edLandmark: $('#ed-landmark').val().trim()
            },
            success: function (){
               displayData();    
               $.magnificPopup.close();       
            }
        })
    }
});


$('body').on('mouseover', '.popup-with-zoom-anim', function (){
    $('.popup-with-zoom-anim').magnificPopup({
        type: 'inline',

        fixedContentPos: false,
        fixedBgPos: true,

        overflowY: 'auto',

        closeBtnInside: true,
        closeOnBgClick: false,
        preloader: false,
        
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });
});

let scriptPlaceCse = "<script id=script-place-cse async=true src='https://cse.google.com/cse.js?cx=22bdf86666de74d21'></script>";


$('body').on('click', '.see-more', function(){
    let mCountry = $('#m-country').text();
    let mCity = $('#m-city').text();
    let mLandmark = $('#m-landmark').text();

    $('.modal').scrollTop(0);
    $('.search-engine').append("<div class='gcse-searchresults-only' sandbox='allow-storage-access-by-user-activation allow-scripts allow-same-origin'></div>");
    $('#scripts').append(scriptPlaceCse);
    let recaptcha = 'https://www.google.com/recaptcha/api2/bframe?hl=en&v=Gg72x2_SHmxi8X0BLo33HMpr&k=6LdE6qgbAAAAANq2Tal4NuP8YdGwtfdTpCLArNE-';
    // $('.gcse-searchresults-only').requestStorageAccess()
    // setTimeout(() => {
        // $('.lds-ring').addClass('lds-ring-hide')
        // $(recaptcha).requestStorageAccess().then(
        //     () => { console.log('access granted') },
        //     () => { console.log('access denied') }
        //     )
            // .then(
                
            //     () => {  }
            // );
    //   }, 4000);
    // $('.gsc-control-cse').onload(function(){
    //     hideLoader();
    //     console.log('testtest');
    // });
    window.history.replaceState(null, null, "?q="+mCountry +' ' + mCity +' ' + mLandmark +' ');
    
});

$('body').on('click', '.modal-edit', function(){
    $('.edit-field').addClass('edit-field-visible');
});

function unloadModalCse(){
    $('.edit-field').removeClass('edit-field-visible');

    window.history.replaceState(null, null, "?q=");
    $(document).find('script[src="https://cse.google.com/cse.js?cx=22bdf86666de74d21"]').remove();
    $(document).find('script[src="https://www.google.com/cse/static/element/f275a300093f201a/cse_element__en.js?usqp=CAI%3D"]').remove();
    $('.search-engine').find('.gsc-control-cse').remove(); 
    // $('.lds-ring').removeClass('lds-ring-hide');
}

$('body').on('click', '.mfp-close', function(){
    unloadModalCse();
});
    
$('body').keydown(function(e){
    if (e.keyCode === 27) {
        unloadModalCse();
    }
});

window.history.replaceState(null, null, "?q=");

///change to append script upon dom modification
$('#map-section').ready(function(){
    $('#map').append("<script src='map-script.js'></script>");
});

///function for main map markers
$('#map').ready(function(){
    
    $('.data-row').each(function(){
        let coText = $(this).children('#country-text').text();
        let ciText = $(this).children('#city-text').text();
        // let laText = $(this).children('#landmark-text').text();

        
        if (coText.length > 0 && ciText.length > 0) {
            $.getJSON("worldcities.json", function(data){

                $.each(data.worldcities, function (){

                    if (coText  === (this["country"]) && ciText === (this["city"])) {
                    
                        const country = new maplibregl.Marker()
                        .setLngLat([this["lng"], this["lat"]])
                        .addTo(map);
                    }
                    

                    
                });//main closing bracket for each

            });

        }                
        else if (coText.length > 0 && ciText.length === 0) {
            $.getJSON("countrieswcoordinates.json", function(resp){
                $.each(resp.countries, function(){
                    
                    if (coText  === (this.name["common"])) {
                    
                        const country = new maplibregl.Marker()
                        .setLngLat([this.latlng[1], this.latlng[0]])
                        .addTo(map);

                    }
                })
                
            })        
            } else{
                console.log('error')
            }
    })  
});



$('body').on('click', '.see-more' , function(){

    $('.edit-field').removeClass('edit-field-visible');       
    let mCountry = $('#m-country').text();
    let mCity = $('#m-city').text();
    let mLandmark = $('#m-landmark').text();

    if (mLandmark.length <= 0) {
        $('#m-landmark').hide();
        $('#mlc').hide();
    }        
    if (mCity.length <= 1) {
        $('#m-city').hide();
        $('#mcc').hide();
    } 
    if (mCountry.length <= 1) {
        $('#m-country').hide();
        $('#mcc').hide();
    } 
    if (mCountry.length <= 1 && mCity.length <= 1) {
        $('#mlc').hide();
    }
   
    // setTimeout(() => {
    //     $('.lds-ring').addClass('lds-ring-hide')
    // }, 4000);
    
    setTimeout(() => {
    
        if (mCountry.length > 0 && mCity.length > 0) {
            $.getJSON("worldcities.json", function(data){

                $.each(data.worldcities, function (){

                    if (mCountry  == (this["country"]) && mCity == (this["city"])) {
                                                    
                        $('#fCountry').children('span').html(this["country"]);
                        $('#fCity').children('span').html(this["city"]);
                        $('#cityPop').children('span').html(Number(this["population"]).toLocaleString("en-US"));

                        
                        const key = '3UHgzHjbiaCYC7Bdr6V1';
                        const map = new maplibregl.Map({
                            container: 'modal-map',
                            style: `https://api.maptiler.com/maps/35df50b2-be27-431c-890b-23ce12b847e1/style.json?key=3UHgzHjbiaCYC7Bdr6V1`,
                            center: [this["lng"], this["lat"]],
                            zoom: 4
                        });
                        map.addControl(new maplibregl.NavigationControl(), 'top-right');
                                                
                        const country = new maplibregl.Marker()
                        .setLngLat([this["lng"], this["lat"]])
                        .addTo(map);
                        

                        // console.log((this["country"]) + (this["city"]));
                    };

                })
                
                
            });//end of getjson block
        } //end of if block
        else if (mCountry.length > 0 && mCity.length === 0) {
            $.getJSON("countrieswcoordinates.json", function(resp){
                $.each(resp.countries, function(){
                    
                    if (mCountry  === (this.name["common"])) {
                        const key = '3UHgzHjbiaCYC7Bdr6V1';
                        const map = new maplibregl.Map({
                            container: 'modal-map',
                            style: `https://api.maptiler.com/maps/35df50b2-be27-431c-890b-23ce12b847e1/style.json?key=3UHgzHjbiaCYC7Bdr6V1`,
                            center: [this.latlng[1], this.latlng[0]],
                            zoom: 4
                        });

                        map.addControl(new maplibregl.NavigationControl(), 'top-right');

                        const country = new maplibregl.Marker()
                        .setLngLat([this.latlng[1], this.latlng[0]])
                        .addTo(map);                     
                                                
                        $('#fCountry').children('span').html(this.name["common"]);

                    }


                })//each block


                
            })///getjson block
        }
        
        
        // else if (mCountry  == (this["country"]) && mCity == (this["city_ascii"])) {
        //     $('#section-facts').append((this["country"]) + (this["city_ascii"]));
        //     console.log((this["country"]) + (this["city_ascii"]));
        // }
        
        $.getJSON("countrieswcoordinates.json", function(info){
            $.each(info.countries, function(){
                if (mCountry  === (this.name["common"])) {

                    const currencies = this.currencies;
                    const arrayCurrKeys = Object.keys(currencies);
                    const arrayCurrObjs = Object.values(currencies);
                    // console.log(Object.values(currencies));

                    $('#fCurr').children('span').html(
                        (JSON.stringify(arrayCurrObjs[0].name) + ' (' + arrayCurrKeys[0] +'), ' + JSON.stringify(arrayCurrObjs[0].symbol))
                    .replace(/[{}"]/g, ''));                 
                    
                    $('#fCapital').children('span').html(this.capital);


                    const languages = this.languages;
                    const arrayLangObjs = Object.values(languages);
                    // console.log(Object.values(languages));                   

                    $('#fLangs').children('span').html(
                        JSON.stringify(arrayLangObjs.join(", "))
                        .toString()
                        .replace(/[""]"]/g, ''));
                    
                    if (mCity == (this["capital"])) {
                        $('#fCity').hide();
                    } else if (mCity != (this["capital"])) {
                        $('#cityPop').children('b').prepend('Your ');

                    }


                }
            })
        })


        $.getJSON('worldbankcountriespopmigrantgdp.json', function(list){
            $.each(list, function(){
                if (mCountry == this.country) {
                    $('#countryPop').children('span').html(Number(this.population).toLocaleString("en-US"));
                    $('#fGdp').children('span').html('$' + (Number(this.gdppc)).toLocaleString("en-US"));
                    $('#fMigrants').children('span').html(Number(this.migrant).toFixed(2) + '% of the total population is from immigrant origin.');
                }
            })
        })


        if (mCountry.length === 0) {
            $('#section-modal-map').hide();
            $('#container-section-facts').hide();
            $('#container-people-of').hide();
            $('.flag-container').hide();
        }
        if (mCity.length === 0) {
            $('#fCity').hide();
            $('#cityPop').hide();
        }


        $.getJSON('religiousdemographicspercentage.json', function(data){
            $.each(data, function(){
                if (mCountry == this.Country) {
                    // console.log(data)


                    const religions = this;
                    const {Country, Region, Unaffiliated, Year, ...rest} = religions;
                    // console.log(rest);
                    let valWithPercentage = [];
                    for (const key in rest) {

                        valWithPercentage.push(JSON.stringify(key +': '+ rest[key]+ '%,')
                        .replace(/[""]/g, ''));

                    };
                    
                    // console.log(valWithPercentage);
                    let elements = '';
                    for (let i = 0; i < valWithPercentage.length; i++) {
                        elements += (valWithPercentage[i]+'<br>')
    
                    }
                    $('#fRel').children('span').html(elements);
                }
            })
        })

        $.getJSON('bygovttype.json', function(govts){
            $.each(govts, function(){
                if (mCountry == this.country) {
                    $('#govt').children('span')
                    .html(JSON.stringify(this.government)
                    .replace(/[""]/g, '')
                    );
                    
                } 
            })
        });

    }, 6000);

});
// });


});

// });
