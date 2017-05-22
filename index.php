<?php

include('IK_PHP.php');

$ik = new IK_PHP();

/* Récupérer un incident par état */
$incidents_by_sd = $ik->where('incident','short_description','!*','SAP');
var_dump($incidents_by_sd->body);

$allIncidents = $ik->all('incident');
var_dump($allIncidents);

if($allIncidents->success){
    echo 'HTTP REQUEST SUCCESS';
} else {
    echo 'HTTP REQUEST FAILED';
}

/* BETWEEN Operator */
$incidentsUsingBetweenOperator = $ik->where('incident','priority','BETWEEN','2@4');
var_dump($incidentsUsingBetweenOperator->body);

/* Insérer un incident */
$incident_to_insert = '{"description":"Description incident à partir de IK_PHP","short_description":"Short description incident à partir de IK_PHP","state":"3","assigned_to":"62826bf03710200044e0bfc8bcbe5df1"}';
$ik->insert('incident',$incident_to_insert);

/* Modifier un incident */
$new_incident_values = '{"description":"Nouvelle valeur description","short_description":"Nouvelle valeur short description","state":"2"}';

// 1er param : le nom de la table
// 2eme param : le sys_id de l'enregistrement à modifier
// 3eme param : les nouvelles valeurs à assigner

$response = $ik->update('incident','79b9cb280fd9b20056628c9ce1050e54',$new_incident_values);
if($response->success){
    echo 'DATA UPDATED SUCCESSFULLY';
} else {
    echo 'ERROR WHILE UPDATING THE DATA';
}

/* Supprimer un RITM */
$responseDelete = $ik->delete('sc_req_item','146116200fd9b20056628c9ce1050e1b');
if($responseDelete->success){
    echo 'DATA DELETED SUCCESSFULLY';
} else {
    echo 'ERROR WHILE DELETING THE DATA';
}

/* Récupérer un incident par état */
$incidents_with_new_state = $ik->getBy('incident','state','1');
var_dump($incidents_with_new_state);


?>

