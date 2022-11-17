$(document).ready(function(){
	$('body').on('mouseover', '.popup-with-zoom-anim', function (){
        $('.popup-with-zoom-anim').magnificPopup({
            type: 'inline',
    
            fixedContentPos: false,
            fixedBgPos: true,
    
            overflowY: 'auto',
    
            closeBtnInside: true,
            preloader: false,
            
            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
        })
    })






})