<?php
header("Content-Type: application/json");

// Database configuration - update with your credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'training_system');
define('DB_USER', 'root');
define('DB_PASS', '');

// JWT secret key
define('JWT_SECRET', 'your_secret_key_here');

// Connect to database using PDO
function getDBConnection() {
    static $conn;
    if ($conn === null) {
        try {
            $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Database connection failed']);
            exit;
        }
    }
    return $conn;
}

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

// Helper: get JSON input data
function getInputData() {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!$data) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON input']);
        exit;
    }
    return $data;
}

// CRUD for Student
function getStudents() {
    $conn = getDBConnection();
    $stmt = $conn->query("SELECT id, name, email FROM students");
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($students);
}

function getStudent($id) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT id, name, email FROM students WHERE id = ?");
    $stmt->execute([$id]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($student) {
        echo json_encode($student);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Student not found']);
    }
}

function createStudent() {
    $data = getInputData();
    if (!isset($data['name']) || !isset($data['email'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Name and email are required']);
        exit;
    }
    $conn = getDBConnection();
    $stmt = $conn->prepare("INSERT INTO students (name, email) VALUES (?, ?)");
    try {
        $stmt->execute([$data['name'], $data['email']]);
        http_response_code(201);
        echo json_encode(['message' => 'Student created', 'id' => $conn->lastInsertId()]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to create student']);
    }
}

function updateStudent($id) {
    $data = getInputData();
    $conn = getDBConnection();
    $stmt = $conn->prepare("UPDATE students SET name = ?, email = ? WHERE id = ?");
    try {
        $stmt->execute([$data['name'] ?? null, $data['email'] ?? null, $id]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Student updated']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Student not found or no changes']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to update student']);
    }
}

function deleteStudent($id) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    try {
        $stmt->execute([$id]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Student deleted']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Student not found']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to delete student']);
    }
}

// CRUD for Course
function getCourses() {
    $conn = getDBConnection();
    $stmt = $conn->query("SELECT id, title, description FROM courses");
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($courses);
}

function getCourse($id) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT id, title, description FROM courses WHERE id = ?");
    $stmt->execute([$id]);
    $course = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($course) {
        echo json_encode($course);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Course not found']);
    }
}

function createCourse() {
    $data = getInputData();
    if (!isset($data['title']) || !isset($data['description'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Title and description are required']);
        exit;
    }
    $conn = getDBConnection();
    $stmt = $conn->prepare("INSERT INTO courses (title, description) VALUES (?, ?)");
    try {
        $stmt->execute([$data['title'], $data['description']]);
        http_response_code(201);
        echo json_encode(['message' => 'Course created', 'id' => $conn->lastInsertId()]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to create course']);
    }
}

function updateCourse($id) {
    $data = getInputData();
    $conn = getDBConnection();
    $stmt = $conn->prepare("UPDATE courses SET title = ?, description = ? WHERE id = ?");
    try {
        $stmt->execute([$data['title'] ?? null, $data['description'] ?? null, $id]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Course updated']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Course not found or no changes']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to update course']);
    }
}

function deleteCourse($id) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("DELETE FROM courses WHERE id = ?");
    try {
        $stmt->execute([$id]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Course deleted']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Course not found']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to delete course']);
    }
}

// CRUD for Enrollment
function getEnrollments() {
    $conn = getDBConnection();
    $stmt = $conn->query("SELECT id, student_id, course_id, enrollment_date FROM enrollments");
    $enrollments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($enrollments);
}

function getEnrollment($id) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT id, student_id, course_id, enrollment_date FROM enrollments WHERE id = ?");
    $stmt->execute([$id]);
    $enrollment = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($enrollment) {
        echo json_encode($enrollment);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Enrollment not found']);
    }
}

function createEnrollment() {
    $data = getInputData();
    if (!isset($data['student_id']) || !isset($data['course_id']) || !isset($data['enrollment_date'])) {
        http_response_code(400);
        echo json_encode(['error' => 'student_id, course_id, and enrollment_date are required']);
        exit;
    }
    $conn = getDBConnection();
    $stmt = $conn->prepare("INSERT INTO enrollments (student_id, course_id, enrollment_date) VALUES (?, ?, ?)");
    try {
        $stmt->execute([$data['student_id'], $data['course_id'], $data['enrollment_date']]);
        http_response_code(201);
        echo json_encode(['message' => 'Enrollment created', 'id' => $conn->lastInsertId()]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to create enrollment']);
    }
}

function updateEnrollment($id) {
    $data = getInputData();
    $conn = getDBConnection();
    $stmt = $conn->prepare("UPDATE enrollments SET student_id = ?, course_id = ?, enrollment_date = ? WHERE id = ?");
    try {
        $stmt->execute([$data['student_id'] ?? null, $data['course_id'] ?? null, $data['enrollment_date'] ?? null, $id]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Enrollment updated']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Enrollment not found or no changes']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to update enrollment']);
    }
}

function deleteEnrollment($id) {
    $conn = getDBConnection();
    $stmt = $conn->prepare("DELETE FROM enrollments WHERE id = ?");
    try {
        $stmt->execute([$id]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Enrollment deleted']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Enrollment not found']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to delete enrollment']);
    }
}

// Routing
$method = $_SERVER['REQUEST_METHOD'];
$path = isset($_GET['path']) ? explode('/', trim($_GET['path'], '/')) : [];

if (count($path) == 0) {
    // Root endpoint
    echo json_encode(['message' => 'Welcome to the School API']);
    exit;
}

$resource = $path[0];
$id = $path[1] ?? null;

if ($resource === 'login' && $method === 'POST') {
    login();
    exit;
}

// All other endpoints require authentication
$user = authenticate();

switch ($resource) {
    case 'students':
        switch ($method) {
            case 'GET':
                if ($id) getStudent($id);
                else getStudents();
                break;
            case 'POST':
                createStudent();
                break;
            case 'PUT':
                if ($id) updateStudent($id);
                else {
                    http_response_code(400);
                    echo json_encode(['error' => 'Student ID required']);
                }
                break;
            case 'DELETE':
                if ($id) deleteStudent($id);
                else {
                    http_response_code(400);
                    echo json_encode(['error' => 'Student ID required']);
                }
                break;
            default:
                http_response_code(405);
                echo json_encode(['error' => 'Method not allowed']);
        }
        break;
    case 'courses':
        switch ($method) {
            case 'GET':
                if ($id) getCourse($id);
                else getCourses();
                break;
            case 'POST':
                createCourse();
                break;
            case 'PUT':
                if ($id) updateCourse($id);
                else {
                    http_response_code(400);
                    echo json_encode(['error' => 'Course ID required']);
                }
                break;
            case 'DELETE':
                if ($id) deleteCourse($id);
                else {
                    http_response_code(400);
                    echo json_encode(['error' => 'Course ID required']);
                }
                break;
            default:
                http_response_code(405);
                echo json_encode(['error' => 'Method not allowed']);
        }
        break;
    case 'enrollments':
        switch ($method) {
            case 'GET':
                if ($id) getEnrollment($id);
                else getEnrollments();
                break;
            case 'POST':
                createEnrollment();
                break;
            case 'PUT':
                if ($id) updateEnrollment($id);
                else {
                    http_response_code(400);
                    echo json_encode(['error' => 'Enrollment ID required']);
                }
                break;
            case 'DELETE':
                if ($id) deleteEnrollment($id);
                else {
                    http_response_code(400);
                    echo json_encode(['error' => 'Enrollment ID required']);
                }
                break;
            default:
                http_response_code(405);
                echo json_encode(['error' => 'Method not allowed']);
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Resource not found']);
}
?>
