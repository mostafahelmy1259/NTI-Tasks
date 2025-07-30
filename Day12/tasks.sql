//task 1
SELECT c.title, COUNT(e.student_id) AS student_count FROM courses c LEFT JOIN enrollments e ON c.id = e.course_id GROUP BY c.title HAVING COUNT(e.student_id) > 0;

//task 2
SELECT s.name, COUNT(e.course_id) AS course_count FROM students s LEFT JOIN enrollments e ON s.id = e.student_id GROUP BY s.id, s.name ORDER BY course_count ASC LIMIT 1;

//task 3
SELECT s.name FROM students s LEFT JOIN enrollments e ON s.id = e.student_id WHERE e.course_id IS NULL;

//task 4
SELECT S.name, COUNT(e.course_id) AS course_count FROM students s JOIN enrollments e ON s.id = e.student_id GROUP BY s.id, s.name;
