
Article Creator Script
=======================

Installation
------------

No instalation required, just upload it to your server.
However before uploading the script to your server, you need to make a few changes on below files:

- go.php
  
  line 90: $baseurl = "http://localhost/xampp/articlecreator/";
  change above url to the url where you will upload the script i.e "http://yourdomain.com/" or "http://sub.yourdomain.com/"
  
- accesskey.php
  for the security reason we use the access key. edit this file if you want to add, remove or edit the access key
  
- unik.php (optional)
  This file contains synonyms database, edit this file to edit and improve the rewriter feature. 
  You can easily add, edit, remove the synonyms.
  
Once you have modified above files, upload all files and folders, keep all file & directory names and their structure.
Make sure "cache" and "tempfiles" folder and its sub-directory writable e.g. 777.  
  
 
Created by. FullContentRSS.com  
 



