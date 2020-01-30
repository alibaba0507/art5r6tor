var myApp;
myApp = myApp || (function () {
    var pleaseWaitDiv = $('<div class="modal hide" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false"><div class="modal-header"><h1>Processing...</h1></div><div class="modal-body"><div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div></div></div>');
    return {
        showPleaseWait: function() {
            pleaseWaitDiv.modal();
        },
        hidePleaseWait: function () {
            pleaseWaitDiv.modal('hide');
        },

    };
})();
function getSelectionHtml() {
   var html = "";
   if (typeof window.getSelection != "undefined") {
       var sel = window.getSelection();
       if (sel.rangeCount) {
           var container = document.createElement("div");
           for (var i = 0, len = sel.rangeCount; i < len; ++i) {
               container.appendChild(sel.getRangeAt(i).cloneContents());
           }
           html = container.innerHTML;
       }
   } else if (typeof document.selection != "undefined") {
       if (document.selection.type == "Text") {
           html = document.selection.createRange().htmlText;
       }
   }
   return html;
}

function getSelectionText() {
   var text = "";
   if (window.getSelection) {
       text = window.getSelection().toString();
   } else if (document.selection && document.selection.type != "Control") {
       text = document.selection.createRange().text;
   }
   return text;
}

function updateTextAea()
{
 var list = document.getElementById('selectWord');
 var s = list[list.selectedIndex].value;
 
 //var textArea = document.getElementById("spin_id");
 if (/*finish &&*/ s.trim().length > 0)
 {
   replaceSelectedText(s);
   //textArea.value = spliceString(textArea.value, start, finish, s + " ");
   //start= 0;
   //finish = 0;
 }
}
    
function replaceSelectedText(replacementText) {
    var sel, range;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.rangeCount) {
            range = sel.getRangeAt(0);
            range.deleteContents();
            range.insertNode(document.createTextNode(replacementText));
        }
    } else if (document.selection && document.selection.createRange) {
        range = document.selection.createRange();
        range.text = replacementText;
    }
}

 function showPos(event, text) {
      /*  var el, x, y;
        document.getElementById('PopUp').style.display = 'none'
        el = document.getElementById('PopUp');
        if (window.event) {
        x = window.event.clientX + document.documentElement.scrollLeft
        + document.body.scrollLeft;
        y = window.event.clientY + document.documentElement.scrollTop +
        + document.body.scrollTop;
        }
        else {
        x = event.clientX + window.scrollX;
        y = event.clientY + window.scrollY;
        }
        x -= 2; y -= 2;
        y = y+15
        el.style.left = x + "px";
        el.style.top = y + "px";
        el.style.display = "block";
        */
        /* var txtarea = document.getElementById("spin_id");
        // obtain the index of the first selected character
        var start = txtarea.selectionStart;
        // obtain the index of the last selected character
        var finish = txtarea.selectionEnd;
        // obtain the selected text
        var sel = txtarea.value.substring(start, finish);
        */
        var hasWords = false;
        $('#selectWord').empty();
        $('#selectWord').append($('<option></option>').val("").html("Select Synonyms ..."));
        text = text.split("|");
        $.each(text, function(i, p) {
            
            if (p.trim().length > 0)
            {
                $('#selectWord').append($('<option></option>').val(p).html(p));
                hasWords = true;
            }
        });
        if (!hasWords)
         document.getElementById('PopUp').style.display = 'none'
        //document.getElementById('PopUpText').innerHTML = text;
    }
   
   
 function showPosAjax(event, divId)
   {
          var el, x, y;
        document.getElementById('PopUp').style.display = 'none'
        el = document.getElementById('PopUp');
        if (window.event) {
        x = window.event.clientX + document.documentElement.scrollLeft
        + document.body.scrollLeft;
        y = window.event.clientY + document.documentElement.scrollTop +
        + document.body.scrollTop;
        }
        else {
        x = event.clientX + window.scrollX;
        y = event.clientY + window.scrollY;
        }
        x -= 2; y -= 2;
        y = y+15
        
        var txtarea = document.getElementById(divId);
        // obtain the index of the first selected character
        // start = txtarea.selectionStart;
        // obtain the index of the last selected character
        // finish = txtarea.selectionEnd;
        // obtain the selected text
        var sel = getSelectionText();//txtarea.value.substring(start, finish);
        // $(".modal").show();
       // alert("showPosAjax Selected Word [" + sel + "]");
         $.ajax({
                url: "./dict.php",
                data: { 'word': '"' + sel + '"' },
                /*dataType: 'JSON',*/
                type: 'POST',
                cache: false,
              beforeSend: function () {
                //alert("Modal Open");
                //$(".modal").show();
              }
            }).done(function(result){
              //  alert(" showPosAjax  Done ...");
                if (result /*&& result.words*/ && result.trim().length > 0)
                {
          //           $(".modal").hide();
                    //alert(JSON.stringify(result));
                   // var words = JSON.stringify(result.words);
                  // if (words.trim().length > 0)
                  // {
                      el.style.left = x + "px";
                    el.style.top = y + "px";
                    el.style.display = "block";
                    showPos(event, result/*.words*/) ;
                   //}
                }
              }).fail(function (jqXHR, textStatus, errorThrown) {
              alert("showPosAjax Failed: " + errorThrown);
            }).always(function (a, textStatus, b) {
              //alert("showPosAjax Final status: " + textStatus);
             // myApp.hidePleaseWait();
          });
   }

function showPosAjaxBuysy(event)
{
    var el, x, y;
    document.getElementById('dialog').style.display = 'none'
    el = document.getElementById('dialog');
    var w = $(window).width();
    var h = $(window).height();
    var d = document.getElementById('my-div');
    var divW = $(d).width();
    var divH = $(d).height();

    el.style.position="absolute";
    el.style.top = (h/2)-(divH/2)+"px";
    el.style.left = (w/2)-(divW/2)+"px";
    el.style.display = "block";
        
    
}    
function hidePosAjaxBuysy()
{
      document.getElementById('dialog').style.display = 'none'
}
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
        // alert("Before Send ajax ---- ");
        //myApp.showPleaseWait();
        showPosAjaxBuysy();
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
     // alert("Final status: " + textStatus);
     // myApp.hidePleaseWait();
     hidePosAjaxBuysy();
  });
};
        
//$('.rewrite').on('click', rewriteArticle);