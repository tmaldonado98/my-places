$(document).ready(function(){
    // $('tbody').sortable('refresh');
    $('tbody').sortable({
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

})


// function selectedRow(){
    // let rows = $('.data-row');
    // let checkbox = $('.checkbox');
 
    // for (let i = 0; i < rows.length; i++) {


    //     // $('body').on('focus blur', checkbox[i], function(){
    //     // })         
        
    //     // })
    //     $(checkbox[i]).change(()=>{
    //         if ($(checkbox[i]).attr('checked', true)) {
    //             $(rows[i]).addClass('selectedRow')
    //         }
    //         else if ($(checkbox[i]).attr('checked', false)) {
    //             $(rows[i]).removeClass('selectedRow')
    //         }
            
    //     });
    // }
// };

$('body').on('focus blur', '.checkbox', function(){
    // selectedRow()
    let rows = $('.data-row');
    let checkbox = $('.checkbox');
 
    for (let i = 0; i < rows.length; i++) {

        $(checkbox[i]).change(()=>{
            if ($(checkbox[i]).attr('checked', true)) {
                $(rows[i]).toggleClass('selectedRow')
            }
            else if ($(checkbox[i]).attr('checked', false)) {
                $(rows[i]).toggleClass('selectedRow')
            }
            
        });
    }
});

$('body').on('change', '#sel-all', function (e) {
    if ($('#sel-all').attr('checked', true)) {
        $('.data-row').addClass('selectedRow')
    }
    if ($('#sel-all').attr('checked', false) && $('.checkbox:checked').length == 0) {
        $('.data-row').removeClass('selectedRow')
    }
});