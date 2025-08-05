<?php
require_once 'config.php';

header("Content-Type: application/json");

// Simple JWT functions (encode/decode)
function base64UrlEncode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64UrlDecode($data) {
    $pad = 4 - (strlen($data) % 4);
    if ($pad < 4) {
        $data .= str_repeat('=', $pad);
    }
    return base64_decode(strtr($data, '-_', '+/'));
}

function jwtEncode($payload, $secret) {
    $header = base64UrlEncode(json_encode(['typ'=>'JWT','alg'=>'HS256']));
    $payload = base64UrlEncode(json_encode($payload));
    $signature = base64UrlEncode(hash_hmac('sha256', "$header.$payload", $secret, true));
    return "$header.$payload.$signature";
}

function jwtDecode($jwt, $secret) {
    $parts = explode('.', $jwt);
    if (count($parts) !== 3) return false;
    list($header64, $payload64, $signature64) = $parts;
    $header = json_decode(base64UrlDecode($header64), true);
    $payload = json_decode(base64UrlDecode($payload64), true);
    $signature = base64UrlDecode($signature64);
    $validSig = hash_hmac('sha256', "$header64.$payload64", $secret, true);
    if (!hash_equals($validSig, $signature)) return false;
    return $payload;
}

// Get bearer token from Authorization header
function getBearerToken() {
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } else if (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}

// Authenticate request
function authenticate() {
    $token = getBearerToken();
    if (!$token) {
        http_response_code(401);
        echo json_encode(['error' => 'Access token required']);
        exit;
    }
    $payload = jwtDecode($token, JWT_SECRET);
    if (!$payload || !isset($payload['user'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid access token']);
        exit;
    }
    return $payload['user'];
}

// Simple user login for demo (username: admin, password: admin123)
function login() {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['username']) || !isset($data['password'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Username and password required']);
        exit;
    }
    $username = $data['username'];
    $password = $data['password'];
    if ($username === 'admin' && $password === 'admin123') {
        $payload = [
            'user' => $username,
            'iat' => time(),
            'exp' => time() + 3600
        ];
        $token = jwtEncode($payload, JWT_SECRET);
        echo json_encode(['token' => $token]);
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid credentials']);
    }
}
?>
