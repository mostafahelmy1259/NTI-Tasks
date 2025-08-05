<?php
require_once 'config.php';
require_once 'auth.php';
require_once 'student.php';
require_once 'course.php';
require_once 'enrollment.php';

header("Content-Type: application/json");

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
