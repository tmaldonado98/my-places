$(document).ready(function(){
    $('tbody').sortable({
        ///disables sortable for heading row
        items: 'tr:not(#heading-row)',
        distance: 20,

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

////attempting to highlight row upon checkbox selection
// $('.checkbox').click(()=>{
//     $(this).closest('td').css({'background-color': 'rgb(255, 255, 255, 0.7)', 'color': 'gray'})
// })  



function selectedRow(){
    let rows = $('.data-row');
    let checkbox = $('.checkbox');
 
    for (let i = 0; i < rows.length; i++) {
        $(checkbox[i]).change(()=>{
            $(rows[i]).toggleClass('selectedRow');
        })         
    }
};

$('body').on('focus', '.checkbox', function(){
    selectedRow()
});

// $('checkbox').prop('checked', true).change(()=>{
//     $(this).closest('.data-row').css({'background-color': 'rgb(41, 41, 96)', 'color': 'white'})
// })
    // ///THIS STILL NEEDS WORK
    // if ($('checkbox').prop('checked') == true) {
    //     // $('#del-sel').prop('disabled', true);
    //     $('#del-sel').attr('style', 'background-color:red')
    // } 