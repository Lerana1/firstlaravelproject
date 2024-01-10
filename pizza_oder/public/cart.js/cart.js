$(document).ready(function () {
    $('.btn-plus').click(function() {
        $nodes = $(this).parents("tr");
        $price = Number($nodes.find('#price').text().replace("kyats","") );
        console.log($price);
    })
})
