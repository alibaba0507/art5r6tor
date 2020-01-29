$(".modal").hide();
var rewriteArticle = function(id){
   
    var fromClass = '.needs-rewrite' + id;
    var toClass = '.spin_txt' + id;
 alert("Before Call ajax ---- "  +  $(fromClass).text());   
   $.ajax({
        url: "./ajaxUnike.php",
        data: { 'article': $(fromClass).text() },
        dataType: 'JSON',
        type: 'POST',
        cache: false,
        beforeSend: function () {
        // Update the css and center the modal on screen
         alert("Before Send ajax ---- ");   
        $(".modal").show();
      },
    complete: function () {
        alert("After Complete ajax ---- ");  
        $(".modal").hide();
    }
    }).done(function(result){
        alert("AJax Done " + result.tmp);
       // $('.rewritten').val(result.tmp);
        $(toClass).html(result);
    });
};
        
//$('.rewrite').on('click', rewriteArticle);