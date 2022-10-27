if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location );
};

$(document).ready(()=>{
    $('.text').attr('style', 'text-transform:capitalize');
    // $('.text').val('');
    $('input[name=country]').focus();
});

$('#add-place').submit(()=>{
    if ($('#country').val() == '' && $('#city').val() == '' && $('#landmark').val() == '') {
        return false
    }
});

////AJAX SECTION
///PUTTING FORM INFO INTO AN OBJECT
// let placeObj = {
//     "country": $('.text[name=country]').val(),
//     "city": $('.text[name=city]').val(),
//     "landmark": $('.text[name=landmark]').val()

// }
/*
$(document).ready(()=>{
    $('#btn1').click(()=>{
        $('#table').load('placesdata.json')
    });
});


    let xhr = new XMLHttpRequest();
xhr.onload = function (){
    if (xhr.status === 200) {
        JSON.parse(xhr.responseText);
    }
    // $(document).xhr.responseText;
}
xhr.open('get', 'placesdata.json', true);
xhr.send();
*/

///AJAX SUBMIT




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
    if ($('#country').val().length >= 20) {
        return false;
    };
});
$('#city').keypress(()=>{
    if ($('#city').val().length >= 20) {
        return false;
    };
});
$('#landmark').keypress(()=>{
    if ($('#landmark').val().length >= 20) {
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


// $('#del-sel').attr('disabled', true);

// if ($('.checkbox').prop('checked', false)) {
//     $('#del-sel').attr('disabled', true);
// } else if ($('.checkbox').prop('checked', true)) {
//     $('#del-sel').attr('disabled', false);
// }


////THE FIRST BLOCK OF CODE SELECTS ALL BOXES WHEN SELECT ALL BTN IS CHECKED
///SECOND BLOCK MAKES THE CHECKED STATUS OF THE SELECT ALL BTN CONGRUENT W/ OTHER BTNS

$('#sel-all').change(()=>{
    if ($(this).prop('checked', true)) {
        $('input[type=checkbox]').prop("checked", $('#sel-all').prop("checked"));
        // $('#del-sel').attr('disabled', false);
    } 
    else if ($(this).prop('checked', false)) {
        $('.checkbox').prop("checked", false);
        // $('#del-sel').attr('disabled', true);
    }
});


$('.checkbox').change(()=>{
    if ($(this).prop("checked", false)) {
        $('#sel-all').prop("checked", false)
    };

    if ($('.checkbox:checked').length == $('.checkbox').length) {
        $('#sel-all').prop("checked", true)
    };


    ///THIS STILL NEEDS WORK
    if ($('checkbox').prop('checked') == true) {
        // $('#del-sel').prop('disabled', true);
        $('#del-sel').attr('style', 'background-color:red')
    } 

    // if ($('.checkbox').prop('checked') == false) {
    //     $('#del-sel').prop('disabled', false);
    // }

});

///THESE TWO BLOCKS OF CODE DISABLE DELETE BUTTON IF NO CHECKBOXES ARE SELECTED
// AND ENABLES THE BTN WHEN BOXES ARE SELECTED

$('#del-sel').click(()=>{
    if ($('.checkbox:checked').length > 0) {
        return true;
    } 
    else {
        return false;
    }
     
    // if ($('.checkbox').prop('checked', true)) {
    //     return true;
    // } 

    // else if ($('.checkbox').prop('checked', true)) {
    //     return true;
    // }
})


////CODE TO MAKE EDIT ROW APPEAR UPON MOUSE HOVER OVER ROW
/* $('.data-row').mouseover(()=>{
    $('.edit-row').prop('style', 'display: block');
});
$('.data-row').mouseout(()=>{
    $('.edit-row').prop('style', 'display:none');
});  */

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


$('.see-more').click(function(){
    $(this).siblings('dialog').fadeIn('250ms')
});
    

$('.close').click(function(){
    $(this).closest('dialog').fadeOut('250ms');  
})


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

        // let xhr = new XMLHttpRequest();
        // xhr.readystatechange() = function(){
        //     if (this.readyState == 4 && this.status == 200) {
                
        //     }
        // }

        //AJAX DISPLAY DB DATA

$(document).ready(function(){

    $.ajax({        
        type: 'GET',
        url: 'data.php',
        dataType: 'html',
        success: function(data){
            $('#table-body').append(data);
        }
    });
})

//AJAX INSERT
function submitData(action){
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
            // success: function (response){
            //     $.ajax({
            //         url: 'data.php',
            //         type: 'GET'
            //     })
                
            // }
        });
    })
}



//AJAX DELETE
// $('btn1').click(()=>{
//     $.ajax({
//         method: 'GET',
//         url: 'delete.php',

//     }).done();
// });
    