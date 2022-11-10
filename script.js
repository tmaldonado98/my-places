if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location );
};
let focusTop = $('body').find(('input[name=country]')).focus();

$(document).ready(()=>{
    $('.text').attr('style', 'text-transform:capitalize');
    // $('.text').val('');
    focusTop;
});

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

$('input').keypress((e)=>{
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

////MAKES ADD ROW BUTTON APPEAR UPON ENTERING A LETTER VALUE IN ANY OF
// THE THREE TEXT FIELDS. THIS IS DONE IN ORDER TO AVOID ADDING EMPTY ROWS INTO DB
$('.text').keyup((e)=>{
    if ($('#country').val().length > 0 || $('#city').val().length > 0 || $('#landmark').val().length > 0) {
        $('#btn1').attr('style', 'visibility:visible');
    } else {
        $('#btn1').attr('style', 'visibility:hidden'); 
    };
});


$('#print').click(()=>{
    print();    
});


////THE FIRST BLOCK OF CODE SELECTS ALL BOXES WHEN SELECT ALL BTN IS CHECKED
///SECOND BLOCK MAKES THE CHECKED STATUS OF THE SELECT ALL BTN CONGRUENT W/ OTHER BTNS

// $('#sel-all').change(()=>{
//     if ($(this).prop('checked', true)) {
//         $('input[type=checkbox]').prop("checked", $('#sel-all').prop("checked"));
//         // $('#del-sel').attr('disabled', false);
//     } 
//     else if ($(this).prop('checked', false)) {
//         $('.checkbox').prop("checked", false);
//         // $('#del-sel').attr('disabled', true);
//     }
// });

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
    console.log($('.checkbox').is(':checked'))
});

$('body').on('click', '#sel-all', function(){
    if ($('#sel-all:checked') && $('.checkbox:checked').length == $('.checkbox').length) {
        $('.del-sel').addClass('del-sel-visible');
    } 
    else if ($('#sel-all').attr('checked', false)) {
        $('.del-sel').removeClass('del-sel-visible');        
    } 
});



///THESE TWO BLOCKS OF CODE DISABLE DELETE BUTTON IF NO CHECKBOXES ARE SELECTED
// AND ENABLES THE BTN WHEN BOXES ARE SELECTED

// $('body').on('click', '#del-sel', function(){
//     if ($('.checkbox:checked').length > 0) {
//         return true;
//     } 
//     else if ($('.checkbox:checked').length == 0) {
//         return false
//     }
// });

///updated code on rows.js.... delete later
/*
$('.checkbox').change(()=>{  
    // if ($('.checkbox').prop('checked') == false) {
    //     $('#del-sel').attr("disabled", true);
    // }  if ($('.checkbox').prop('checked') == true) {
    //     $('#del-sel').attr("disabled", false);
    // } 


    // if ($(this).prop('checked', true)) {
    //     $('#del-sel').attr("disabled") == false;
    // } else {
    //     $('#del-sel').attr("disabled") ==true;
    // }

if ($(this).prop('checked', true)) {
        $('#del-sel').prop("disabled", false);
    } else {
        if ($(this).prop('checked', false)) {
            $('#del-sel').prop("disabled", true);
        }
    } 
    

    // else {
    //     $('#del-sel').prop("disabled", true);
    // } 
    
     

    //  if ($(this).prop('checked') == false) {
    //     $('#del-sel').attr('disabled', false);
    // }
});
*/

/*
$('body').on('click', '.see-more', function(){
    $(this).siblings('.modal').fadeIn('100ms')
});
    
$('body').on('click', '.close', function(){
    $(this).closest('.modal').fadeOut('100ms');  
});*/


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
            success: function (response){
               displayData();           
            }
        })
    })
};

    //AJAX DISPLAY DB DATA
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
    };
    
    function displayData(){
        $.ajax({        
            type: 'GET',
            url: 'data.php',
            dataType: 'html',
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
                focusTop;
                $('#btn1').attr('style', 'visibility:hidden');

            }
    });
};

///AJAX EDIT ROW 

/*
function editRowAjax(){
    $.ajax({
        type: 'GET',
        url: 'editRow.php?editid='. $marker,
        dataType: 'html',
        success: function(data){
            $('#edit-row').append('<div>');
            $('#edit-row div').append(data);
            $('#edit-row div content').append('</div>');
        }
    })
}

*/

// AJAX DELETE

function deleteData(){
    $(document).ready(function (){
        let id = [];
        let confirmalert = confirm('Are you sure?');
        
        if (confirmalert == true) {
            
            $('.checkbox:checked').each(function (i){
                id[i] = $(this).val();
            });

            
            $.ajax({
                method: 'POST',
                url: 'delete.php',
                data: {id:id},
                success: function () {
                    console.log('deleted');
                    displayData();
                    // loadTotalPlaces();

                    // $('body').find($('.checkbox:checked').closest('.data-row')).fadeOut('250ms');
                    // $('.del-sel').removeClass('del-sel-visible');
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
                displayData();
            }
        })
    }


};
