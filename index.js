$('.btn1').click(()=>{
    let country = $('#country').val();
    let city = $('#city').val();
    let landmark = $('#landmark').val();

    $('.data-row').last().clone(true, true).insertAfter($('.data-row'));
});