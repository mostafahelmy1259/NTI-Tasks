<?php
    header("Content-Type: application/json");
    include "../db.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // ✅ التحقق من أن id رقم صحيح
        if (!is_numeric($id)) {
            http_response_code(400); // Bad Request
            echo json_encode(["status" => "error", "message" => "Invalid ID"]);
            exit;
        }

        // ✅ جلب الكورس من القاعدة
        $sql = "SELECT * FROM courses WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        // ✅ لو مفيش نتيجة
        if (mysqli_num_rows($result) == 0) {
            http_response_code(404); // Not Found
            echo json_encode(["status" => "error", "message" => "Course not found"]);
            exit;
        }

        // ✅ كورس موجود
        $course = mysqli_fetch_assoc($result);
        echo json_encode([$course]);
    } else {
        // ✅ لو مش محدد id → رجّع كل الكورسات
        $sql = "SELECT * FROM courses";
        $result = mysqli_query($conn, $sql);
        $courses = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $courses[] = $row;
        }
        echo json_encode($courses);
    }
?>