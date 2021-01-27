<?php 
# LIST EMAIL ADDRESS
$recipient = "info.bsky@gmail.com";

# SUBJECT (Subscribe/Remove)
$subject = "Заявка с сайта bogoslavsky.com/fast";

# RESULT PAGE
$location = "action.html";

## FORM VALUES ##

# SENDER - WE ALSO USE THE RECIPIENT AS SENDER IN THIS SAMPLE
# DON'T INCLUDE UNFILTERED USER INPUT IN THE MAIL HEADER!
$sender = "max@bogoslavsky.com";

# MAIL BODY
$body = "Имя: " ."<b>".$_REQUEST['name']."</b>" ." <br>";
$body .= "Телефон: " ."<b>".$_REQUEST['phone']."</b>" ." <br>";
$body .= $_REQUEST['hidden']." \n";
$headers ="Content-type: text/html; charset=UTF-8\r\n";
$headers.="Content-transfer-encoding: quoted-printable";
# add more fields here if required

require_once('../bitrix_crest/crest.php');

CRest::call(
   'crm.lead.add',
   [
      'fields' =>[
	      'TITLE' => $subject,
	      'NAME' => $_REQUEST['name'],
	      "PHONE"=> [
	      	["VALUE" => $_REQUEST['phone']],
	      	["VALUE_TYPE" => "WORK"]
	      ],
	      'UTM_CAMPAIGN' => $_REQUEST['utm_campaign'],
	      'UTM_CONTENT' => $_REQUEST['utm_content'],
	      'UTM_MEDIUM' => $_REQUEST['utm_medium'],
	      'UTM_SOURCE' => $_REQUEST['utm_source'],
	      'UTM_TERM' => $_REQUEST['utm_term']
      ]
   ]);

## SEND MESSGAE ##

mail( $recipient, $subject, $body, $headers ) or die ("Mail could not be sent.");
header( "Location: $location" );
?>