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
    let checkbox = $('checkbox');

    for (let i = 0; i < rows.length; i++) {
        $(checkbox[i]).click(()=>{
            $(rows[i]).css({'background-color': 'rgb(255, 255, 255, 0.7)', 'color': 'gray'})    
            
            // if ($(checkbox[i]).prop("checked", true)) {
            //     $(rows[i]).css({'background-color': 'rgb(255, 255, 255, 0.7)', 'color': 'gray'})    
            // }
            // if ($(rows[i]).closest('checkbox') == checked) {
                
            // }
            
        })    
    }

}

selectedRow();

