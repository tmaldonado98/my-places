$('tbody').sortable({
    handle: '#handle',
    items: 'tr:not(#heading-row)',
    // distance: 20,
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
                    // distance: 20,
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
                $('#insertBtn').attr('style', 'opacity:0');

            }
    });
};