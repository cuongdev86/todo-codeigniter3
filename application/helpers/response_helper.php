<?php

function returnSucess($data, $message = 'Success', $status = 200, $options = [])
{
    $response = [
        'result' => true,
        'message' => $message,
        'data' => $data
    ];
    if (!empty($options)) {
        $response = array_merge($response, $options);
    }
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
function returnError($data = null, $message = 'Error', $status = 500)
{
    $response = [
        'result' => false,
        'message' => $message,
        'data' => $data
    ];
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($response, true);
    exit;
}

function returnNotfound($data = null, $message = 'Not found')
{
    $response = [
        'result' => false,
        'message' => $message,
        'data' => $data
    ];
    http_response_code(404);
    header('Content-Type: application/json');
    echo json_encode($response, true);
    exit;
}

function returnBadRequest($data = null, $message = 'Bad request')
{
    $response = [
        'result' => false,
        'message' => $message,
        'data' => $data
    ];
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode($response, true);
    exit;
}

function returnUnauthorized($message = 'Unauthorized')
{
    http_response_code(401);
    header('Content-Type: application/json');
    echo json_encode(['result' => false, 'message' => $message], true);
    exit;
}

function returnForbidden($message = 'Forbidden')
{
    http_response_code(403);
    header('Content-Type: application/json');
    echo json_encode(['result' => false, 'message' => $message], true);
    exit;
}
