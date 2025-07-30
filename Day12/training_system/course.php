<?php
require_once 'config.php';

header("Content-Type: application/json");

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
?>
