## imaKaPHP

imaKaPHP is a micro library for ServiceNow. It provides multiple functions to retrieve, add, update and delete data through your PHP scripts. This is an alpha version, many improvements are incoming such as : Recursive Data Retrievement, Multi-conditions, Select Specific Fields...

## Installation

The installation is pretty easy. Just edit the ***config.php*** with your instance URL and credentials and include the library in your file using :

```php

include('IK_PHP.php');
$ik = new IK_PHP();

```

## How does it work ? Basic functions :

```php

$incidents = $ik->where('table_name','table_column','operator','value');

$ik->insert('table_name','JSON');

$ik->update('table_name','sys_id','JSON WITH THE NEW VALUES');

$ik->delete('table_name','sys_id');

```

## List of operators

* BETWEEN, value1@value2 : BETWEEN 
* = : EQUALS
* != : IS NOT
* \* : CONTAINS
* *_ : STARS WITH
* !* = NOT LIKE

## How does it work ? Sample code :

```php

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


```
## Motivation

The project is based on PHP programming language, it helps you to interconnect easily your web application with your ServiceNow instance.

## Contributors

I'm looking for contributors to develop and maintain this library. Please let me you know if you want to dive into this project.

## License

This is an Open Source library. 
