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
?>
