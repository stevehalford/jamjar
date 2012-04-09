<?php

require 'Slim/Slim.php';
include_once 'config.php';

$app = new Slim();

$app->get('/clients', 'getClients');
$app->get('/clients/:id', 'getClient');
$app->post('/clients', 'addClient');
$app->put('/clients/:id', 'updateClient');
$app->delete('/clients/:id',  'deleteClient');

$app->get('/clients/:clientId/projects', 'getClientProjects');

$app->get('/projects', 'getProjects');
$app->get('/projects/:id', 'getProject');
$app->post('/projects', 'addProject');
$app->put('/projects/:id', 'updateProject');
$app->delete('/projects/:id',  'deleteProject');

$app->run();

function getClients() {
    $sql = "select * FROM clients ORDER BY name";
    try {
        $db = getConnection();
        $stmt = $db->query($sql);  
        $clients = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        // echo '{"client": ' . json_encode($clients) . '}';
        echo json_encode($clients);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function getClient($id) {
    $sql = "select * FROM clients WHERE id = :id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);  
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $client = $stmt->fetchObject();  
        $db = null;
        // echo '{"client": ' . json_encode($clients) . '}';
        echo json_encode($client);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function addClient() {
    error_log('addclient\n', 3, '/var/tmp/php.log');
    $request = Slim::getInstance()->request();
    $client = json_decode($request->getBody());
    $sql = "INSERT INTO clients (name) VALUES (:name)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);  
        $stmt->bindParam("name", $client->name);
        $stmt->execute();
        $client->id = $db->lastInsertId();
        $db = null;
        echo json_encode($client); 
    } catch(PDOException $e) {
        error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function updateClient($id) {
    $request = Slim::getInstance()->request();
    $body = $request->getBody();
    $client = json_decode($body);
    $sql = "UPDATE clients SET name=:name WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);  
        $stmt->bindParam("name", $client->name);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($client); 
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function deleteClient($id) {
    $sql = "DELETE FROM clients WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);  
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function getProjects() {
    $sql = "select * FROM projects ORDER BY name";
    try {
        $db = getConnection();
        $stmt = $db->query($sql);  
        $projects = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        // echo '{"project": ' . json_encode($projects) . '}';
        echo json_encode($projects);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function getClientProjects($clientId) {
    $sql = "select * FROM projects WHERE client = :clientId ORDER BY name";
    error_log($sql, 3, '/var/tmp/php.log');
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);  
        $stmt->bindParam("clientId", $clientId);
        $stmt->execute();
        $projects = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        // echo '{"project": ' . json_encode($projects) . '}';
        echo json_encode($projects);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function getProject($id) {
    $sql = "select * FROM projects WHERE id = :id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);  
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $project = $stmt->fetchObject();  
        $db = null;
        // echo '{"project": ' . json_encode($project) . '}';
        echo json_encode($project);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function addProject() {
    error_log('addclient\n', 3, '/var/tmp/php.log');
    $request = Slim::getInstance()->request();
    $project = json_decode($request->getBody());
    $sql = "INSERT INTO projects (name, client) VALUES (:name, :client)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);  
        $stmt->bindParam("name", $project->name);
        $stmt->bindParam("client", $project->client);
        $stmt->execute();
        $project->id = $db->lastInsertId();
        $db = null;
        echo json_encode($project); 
    } catch(PDOException $e) {
        error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function updateProject($id) {
    $request = Slim::getInstance()->request();
    $body = $request->getBody();
    $project = json_decode($body);
    $sql = "UPDATE projects SET name=:name, client=:client WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);  
        $stmt->bindParam("name", $project->name);
        $stmt->bindParam("client", $project->client);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
        echo json_encode($project); 
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function deleteProject($id) {
    $sql = "DELETE FROM projects WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);  
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $db = null;
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


function getConnection() {
    $dbh = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);  
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}