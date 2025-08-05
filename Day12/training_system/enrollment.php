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
?>
