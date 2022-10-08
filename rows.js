/*
const draggables = document.querySelectorAll('.draggable');
const containers = $('.drag-container');

$(draggables).each(draggable => {
    $(draggables).on('dragstart', ()=>{
        $(draggables).addClass('dragging');
    })
});
$(draggables).each(draggable => {
    $(draggables).on('dragend', ()=>{
        $(draggables).removeClass('dragging');
    })
});

containers.$each(container => {
    container.on('dragover', ()=>{
        console.log('dragging over');
        const draggable = document.querySelector('.dragging');
        containerappend(draggable);
    })
});*/

$(document).ready(function(){
    $('tbody').sortable();


//     // $('#table').tableDnD({
//     //     onDragClass: "dragging",
//     //     // onDrop: tableDnDUpdate()
//     // });

// //     $('#table').tableDnDUpdate();
})

// function reorderList(){


// }