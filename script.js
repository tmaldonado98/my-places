// if ( window.history.replaceState ) {
//   window.history.replaceState( null, null, window.location );
// };
// let focusTop = $('body').find(('input[name=country]')).focus();

// $(document).ready(()=>{
    // $('.text').attr('style', 'text-transform:capitalize');
    // $('.text').val('');
    // focusTop;
// });

$('#add-place').click(()=>{
    if ($('#country').val() == '' && $('#city').val() == '' && $('#landmark').val() == '') {
        return false
    }
    ///replaced SUBMIT with CLICK event 
});


$('body').on('keypress', '.text', function(e){
    if (e.keyCode === 13) {
        insertData('insert');
    }
//This block enables form to be posted upon pressing ENTER key.
// Not submitted, but posted with AJAX
});


$('#btn1').attr('style', 'visibility:hidden');

////THIS EVENT CAPITALIZES FIRST LETTER OF EACH WORD IN EACH INPUT FIELD
/// AND INVALIDATES NUMBER KEYS. IT DOES NOT CAPITALIZE EACH FIRST LETTER FOR DB ENTRIES
// IT ALSO ALLOWS FOR COMMAS, PERIODS, SHIFT AND CAPS BUTTONS.

$('body').on('keypress', 'input', function(e){
    $('.text').attr('style', 'text-transform:capitalize');
    
    if (e.keyCode > 47 && e.keyCode < 65 && e.keyCode != 32) {
        return false;
    }
});

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
        $('#btn1').attr('style', 'visibility:visible');
    } else {
        $('#btn1').attr('style', 'visibility:hidden'); 
    };
});


$('.print').click(()=>{
    print();    
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


///Suggestions function
/*
function countrySuggestion(str){
    
    if (str.length == 0) {
        $('#country-sug').val('')
    } else {
        $.ajax({
            method: 'GET',
            url: 'suggest.php',
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


    
//AJAX INSERT
function insertData(action){
    $(document).ready(function (){
        let data = {
            action: action,
            country: $('#country').val(),
            city: $('#city').val(),
            landmark: $('#landmark').val(),  
              
        };

        $.ajax({
            url: 'insert.php',
            type: 'POST',
            data: data,
            success: function (){
               displayData();           
            }
        })
    })
};



    //AJAX DISPLAY DB DATA
    function displayData(){
        $.ajax({        
            type: 'GET',
            url: 'data.php',
            dataType: 'text',
            success: function(result){
                let loadedData = $('#container-table-btns').html(result);
                loadedData;

                loadedData.find('tbody').sortable({
                    ///disables sortable for heading row
                    items: 'tr:not(#heading-row)',
                    distance: 20,
                    refresh: 'true',
            
                    update: function (event, ui){
                        $(this).not('#heading-row').children().each(function (marker){
                            if ($(this).attr('data-position') != (marker+1)) {
                                $(this).attr('data-position', (marker+1)).addClass('updated')
                            }
                            saveNewPositions();
                        })
                    }
            
                });
                $('#country').val('');
                $('#city').val('');
                $('#landmark').val('');
                // focusTop;
                $('#btn1').attr('style', 'visibility:hidden');

            }
    });
};

function saveNewPositions(){
    let positions = [];
    $('.updated').each(function (){
        positions.push([$(this).attr('data-marker'), $(this).attr('data-position')]);
        $(this).removeClass('updated');
    });

    $.ajax({
        url: 'places.php',
        method: 'POST',
        dataType: 'text',
        data: {
            update: 1,
            positions: positions
        }
    });   
}


// AJAX DELETE

function deleteData(){
    $(document).ready(function (){
        let id = [];
        let confirmalert = confirm('Are you sure?');
        
        if (confirmalert == true) {
            
            $('body').find('.checkbox:checked').each(function (i){
                id[i] = $(this).val();
            });

            
            $.ajax({
                method: 'POST',
                url: 'delete.php',
                data: {id:id},
                success: function () {
                    console.log('deleted');
                    displayData();
                }
            })
            
        }
    })
};

function modalDelete(rowData) {

    let confirmalert = confirm('Are you sure?');
    
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


};

///AJAX EDIT ROW

// $('body').on('click', 'input[name=update]', function (){
function edit(action){

    $(document).ready(function (){
        // let data = {
        //     action: action,
        //     id: $('#editBtn').attr('dataId'),
        //     edCountry: $('#ed-country').val(),
        //     edCity: $('#ed-city').val(),
        //     edLandmark: $('#ed-landmark').val()
        // }
        
        $.ajax({
            // url: 'editRow.php',
            method: 'POST',
            // cache: false,
            data: {
                // action: 'edit',
                id: $('#editBtn').attr('dataId'),
                edCountry: $('#ed-country').val(),
                edCity: $('#ed-city').val(),
                edLandmark: $('#ed-landmark').val()
            },
            dataType: 'html',
            success: function (){
                console.log('edit ajax posted');
                displayData()           
                $.magnificPopup.close();
            }
        })
    });
};    
// })


$('div[name=edit_field]').css('transition','250ms');
$('div[name=edit_field]').css('opacity','0');


$('body').on('click', 'a[name=see-more]', function(){
    let mCountry = $('#m-country').text();
    let mCity = $('#m-city').text();
    let mLandmark = $('#m-landmark').text();

    ////****************
    $('.modal').addClass('cursorProgress')
    $('#search-engine').append("<div class='gcse-searchresults-only'></div>");
    $('head').append("<script async=true src='https://cse.google.com/cse.js?cx=22bdf86666de74d21'></script>")
    // if ($('#modal-map').ready()) {
    //     $('.modal').removeClass('cursorProgress')
    // }

    window.history.replaceState(null, null, "?q="+mCountry +' ' + mCity +' ' + mLandmark +' ');
    
});

$('body').on('click', '#modal-edit', function(){
    $('div[name=edit_field]').css('transition','250ms')
    $('div[name=edit_field]').css('opacity','1')
});

$('body').on('click', '.mfp-close', function(){
    $('div[name=edit_field]').css('transition','250ms')
    $('div[name=edit_field]').css('opacity','0')

    window.history.replaceState(null, null, "?q=");
    $('head').find('script[src="https://cse.google.com/cse.js?cx=22bdf86666de74d21"]').remove();
    $('head').find('script[src="https://www.google.com/cse/static/element/f275a300093f201a/cse_element__en.js?usqp=CAI%3D"]').remove();
    $('.gcse-searchresults-only').remove(); 
    
});

$('.modal').on('unload', function(){
    $('div[name=edit_field]').css('transition','250ms')
    $('div[name=edit_field]').css('opacity','0')

    window.history.replaceState(null, null, "?q=");
    $('head').find('script[src="https://cse.google.com/cse.js?cx=22bdf86666de74d21"]').remove();
    $('head').find('script[src="https://www.google.com/cse/static/element/f275a300093f201a/cse_element__en.js?usqp=CAI%3D"]').remove();
    $('.gcse-searchresults-only').remove(); 
});


$('body').keydown(function(e){
    if (e.keyCode === 27) {
        $('div[name=edit_field]').css('transition','250ms')
        $('div[name=edit_field]').css('opacity','0')
        
        window.history.replaceState(null, null, "?q=");
        $('head').find('script[src="https://cse.google.com/cse.js?cx=22bdf86666de74d21"]').remove();
        $('head').find('script[src="https://www.google.com/cse/static/element/f275a300093f201a/cse_element__en.js?usqp=CAI%3D"]').remove();
        $('.gcse-searchresults-only').remove();
    }
});

window.history.replaceState(null, null, "?q=");

$('#map-section').ready(function(){
    $('#map').append("<script src='map-script.js'></script>");
});

$('#container-table-btns').ready(function(){

    $('.data-row').each(function(){
        let coText = $(this).children('#country-text').text();
        let ciText = $(this).children('#city-text').text();
        let laText = $(this).children('#landmark-text').text();

    locateTxt = coText + ' ' + ciText + ' ' + laText;

        $.ajax({
            url: 'https://geocode.xyz',
            data: {
              auth: '803066415173447662518x121329',
              locate: locateTxt,
              json: '1'
            }
          }).done(function(data) {
            // console.log(data["longt"], data["latt"]);

            const country = new maplibregl.Marker()
            .setLngLat([data["longt"], data["latt"]])
            .addTo(map);
        
        })
    })  
});

$('body').on('click', 'a[name=see-more]' , function(){

    $('.modal').ready(function() {
        let mCountry = $('#m-country').text();
        let mCity = $('#m-city').text();
        let mLandmark = $('#m-landmark').text();
        // $('#modal-map').append("<script src='map-script.js'></script>");

        locateTxt = mCountry + ' ' + mCity + ' ' + mLandmark;

        $.ajax({
            url: 'https://geocode.xyz',
            data: {
              auth: '803066415173447662518x121329',
              locate: locateTxt,
              json: '1'
            }
          }).done(function(data) {
            // console.log(data["longt"], data["latt"]);
            // console.log(locateTxt);
            
            const key = '3UHgzHjbiaCYC7Bdr6V1';
            const map = new maplibregl.Map({
                container: 'modal-map',
                style: `https://api.maptiler.com/maps/35df50b2-be27-431c-890b-23ce12b847e1/style.json?key=3UHgzHjbiaCYC7Bdr6V1`,
                center: [data["longt"], data["latt"]],
                zoom: 5
            });
            map.addControl(new maplibregl.NavigationControl(), 'top-right');


        const country = new maplibregl.Marker()
        .setLngLat([data["longt"], data["latt"]])
        .addTo(map);
    
        });
    })
});