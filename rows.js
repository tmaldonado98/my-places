$(document).ready(function(){
    $('tbody').sortable({
        ///disables sortable for heading row
        cancel: "#heading-row",
        distance: 20,

        update: function (event, ui){
            $(this).children().each(function (marker){
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
$('.checkbox').click(()=>{
    $(this).closest('td').addClass('.selectedRow')
})  