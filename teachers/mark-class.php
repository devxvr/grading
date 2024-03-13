    <?php

    require_once '../includes/database.php';

    class MarkList {
        protected $db;

        function __construct() {
            $this->db = new Database();
        }

        function add($assessment_id, $student_id, $mark) {
            // Check if assessment_id exists in assessment_list table
            $assessmentCheckSql = "SELECT * FROM assessment_list WHERE assessment_id = :assessment_id";
            $assessmentCheckQuery = $this->db->connect()->prepare($assessmentCheckSql);
            $assessmentCheckQuery->bindParam(':assessment_id', $assessment_id);
            $assessmentCheckQuery->execute();
            $assessmentExists = $assessmentCheckQuery->fetch();
        
            // Check if student_id exists in student_list table
            $studentCheckSql = "SELECT * FROM student WHERE id = :student_id";
            $studentCheckQuery = $this->db->connect()->prepare($studentCheckSql);
            $studentCheckQuery->bindParam(':student_id', $student_id);
            $studentCheckQuery->execute();
            $studentExists = $studentCheckQuery->fetch();
        
            if (!$assessmentExists || !$studentExists) {
                // Either assessment_id or student_id does not exist
                return false;
            }
        
            // Proceed with the insertion
            $sql = "INSERT INTO mark_list (assessment_id, student_id, mark) VALUES (:assessment_id, :student_id, :mark)";
            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':assessment_id', $assessment_id);
            $query->bindParam(':student_id', $student_id); // Corrected parameter name
            $query->bindParam(':mark', $mark);
        
            if ($query->execute()) {
                return true;
            } else {
                return false;
            }
        }
        

        public function fetchMarks($class_id, $assessment_id) {
            $results = [];
            try {
                // Correctly use the database connection as per your class setup
                $query = "SELECT ml.*, s.firstname, s.lastname FROM mark_list ml 
                          INNER JOIN student s ON ml.student_id = s.id 
                          WHERE ml.class_id = :class_id AND ml.assessment_id = :assessment_id";
                $stmt = $this->db->connect()->prepare($query);
                $stmt->bindParam(':class_id', $class_id, PDO::PARAM_INT);
                $stmt->bindParam(':assessment_id', $assessment_id, PDO::PARAM_INT);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Log or handle the error as appropriate for your application
                error_log("Error fetching marks: " . $e->getMessage());
            }
            return $results;
        }
        
        
    }
    ?>
