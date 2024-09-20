<?php
require('../DAL/retrieve.class.php');

if (isset($_GET['courseId'])) {
    $courseId = $_GET['courseId'];
    $universityData = new UniversityDataRetrieval();
    $gradeStructures =  $universityData->getGradeStructures($courseId);

    if ($gradeStructures) {
        foreach ($gradeStructures as $index => $structure) {
            echo '<div class="form-group grade-structure-rows">
                    <label for="assessmentType">Grade Type</label>
                    <div class="input-group">
                    <div class="input-group-prepend">
                            <button type="button" class="btn btn-danger remove-grade">-</button>
                        </div>
                        <input type="text" class="form-control" name="AssessmentType[]" value="' . htmlspecialchars($structure['AssessmentType']) . '" required>
                        
                    </div>
               
                <div class="form-group grade-structure-row">
                    <label for="weight">Percentage (%)</label>
                    <input type="number" class="form-control" name="Weight[]" value="' . htmlspecialchars($structure['Weight']) . '" min="0" max="100" required>
                </div>
               
                 </div>

                ';
        }
    } else {
        echo '<p>No grade structures found for this course.</p>';
    }
}
