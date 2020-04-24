<?php
require_once('../config/config.php');
$home_inc =$options->base_include_dir;
?>
<html>
  <head>
   <?php include($home_inc.'/inc/head.php');?>
  </head>
  <body>
	<?php include($home_inc.'/inc/body_top.php');?>
	<div class="table-responsive">
<form id="fx_condition" onsubmit="handleEmailCleanFormSubmit(this);return false;" class="form-horizontal">
<fieldset>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="textinput">Email List</label>  
  <div class="col-md-8">
  <textarea  id="email_list" name="email_list"   rows="15" cols="50" class="form-control input-md" >
  </textarea>
  <span class="help-block">Copy and Paste list to clean.One email per line</span>  
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
  <button id="submit" type="submit" name="submit" class="btn btn-primary">Submit</button>
   
  </div>
</div>

</fieldset>
</form>
<div id="email_clean_out" class="tab-content content col-sm-12"></div>
</div>

<script>
 function handleEmailCleanFormSubmit(formObject)
{
 // TODO: Trigger somwe front Wait ... show wait animated icon or something 
 // in Modal window
 //alert(">>>>> BEFORE >>>> [" + formObject.email_list.innerText  + "]>>>>");
 //alert(">>>>> BEFORE >>>> [" + formObject.email_list.value  + "][" + disp_emails.length + "]>>>>");
 alert(" This Can be long process ... When done or fail Alert message will be displayed ");
 updateServerEmailCleanForm(formObject.email_list.value );
 alert(" Email Cleaning ... Done");
 /*$.ajax({
   url: "emailAJAX_clean.php",
   method: "POST",
   dataType: "json",
   data: {"email_list": formObject.email_list.value},
   success: function (result) {
      //alert("result: " + result);
      //$("#random").html(result);
	  updateServerEmailCleanForm(result);
	  
   }
 });
 */
// google.script.run.withSuccessHandler(updateServerEmailCleanForm).processEmailCleanForm(formObject);
}

function updateServerEmailCleanForm(data)
{
	
	var lines = data.split('\n');
// alert(">>>>>> LINES[" + lines.length + "]<<<<");
 var valid ='';// [];
 var valid_duplicates = [];
 var invalid = '';//[];
 var constraints = {
  from: {
    email: true
   /* disposable:true*/
  }
 };
 try{
   for(var i = 0;i < lines.length;i++){
      //code here using lines[i] which will give you each line
      //var result = validate.single(lines[i].trim(), {presence: true, email: true,disposable:true});
      var check = lines[i].trim();
      if (check.indexOf(",") > 0)
        check = check.split(",")[0];
      else if (check.indexOf(":") > 0)
        check = check.split(":")[0];
      var result = validate({from: check}, constraints);
      if (result)
      {
      //  alert("> >>>>>>> [" + JSON.stringify(result.from) + "] >>>>>");
        invalid +=(lines[i] + ", " + JSON.stringify(result.from)) + '\n';
      }else
      {
       var em =  check;//lines[i];
       if (!valid_duplicates.find(function (e){return (e.toLowerCase() == em.toLowerCase())}))
       {
         valid += (lines[i]) + '\n';
         valid_duplicates.push(check /*lines[i]*/);
       }else
       {
        invalid += (lines[i] + ",[Duplicate Email]\n");
       }
      }
   }
   var html = '<table><caption>Summary of processed emails</caption><thead><tr>\
                 <th scope="col">Valid Emails</th><th scope="col">Not Valid Emails</th></tr></thead><tbody> \
                 <tr><td data-label="Account">\
                 <textarea  id="email_list_valid" name="email_list_valid"   rows="15" cols="10" class="form-control input-md" >';
   html += valid + '</textarea></td>';
   html += '<td data-label="Due Date"> \
        <textarea  id="email_list_notvalid" name="email_list_notvalid"   rows="15" cols="10" class="form-control input-md" >';
   html += invalid + '</textarea></td></tr></tbody></table>';
  
   const div = document.getElementById('email_clean_out');
   div.innerHTML = html;
   
  }catch (err)
  {
   alert(">>>>> ERROR [" + err.message + "] >>>");
  }
}
</script>

<br /><?php include ($home_inc."/inc/footer.php"); ?>

	</div>
  </body>