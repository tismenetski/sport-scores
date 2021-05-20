var collapseElementList = [].slice.call(document.querySelectorAll('.collapse'))
var collapseList = collapseElementList.map(function (collapseEl) {
    return new bootstrap.Collapse(collapseEl)
})


$(".btn-toggle").click(function(){
    $("#toggle-example").collapse('toggle');
});
