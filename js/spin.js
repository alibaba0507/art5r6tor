$(".modal").hide();
var rewriteArticle = function(id){
   
    var fromClass = '.needs-rewrite' + id;
    var toClass = '.spin_txt' + id;
    var headLine = '#headline' + id;
 alert("Before Call ajax ---- "  +  $(fromClass).text());   
   $.ajax({
        url: "./ajaxUnike.php",
        data: { 'article': $(fromClass).html(),
                'keyword':$('#keyword').val(),
                'keywords':$('#keywords').val(),
                'urllink': $('#urllink').val()},
       /* dataType: 'JSON',*/
        type: 'POST',
        cache: false,
        beforeSend: function () {
        // Update the css and center the modal on screen
         alert("Before Send ajax ---- ");   
        $(".modal").show();
      }
    }).done(function(result){
       // alert("AJax Done " + result);
       // $('.rewritten').val(result.tmp);
       var txt = '';// '<h3>' + $(headLine).val() + '</h3><br>';
       txt += result;
        $(toClass).html(txt);
    }).fail(function (jqXHR, textStatus, errorThrown) {
      alert("Failed: " + errorThrown);
    }).always(function (a, textStatus, b) {
      alert("Final status: " + textStatus);
  });
};
        
//$('.rewrite').on('click', rewriteArticle);