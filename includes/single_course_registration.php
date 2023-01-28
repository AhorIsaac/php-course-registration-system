<?php
require_once("../classes/CourseRegistration.php");
require_once("../classes/Course.php");

$course_registration = new CourseRegistration();
$my_courses = $course_registration->my_registration($_POST["id"]);

$output = ' 
<table class="table table-striped table-hover">
    <thead class="bg-secondary">
        <tr>
            <th> SN </th>
            <th> Code </th> 
            <th> Title </th>
            <th> Unit </th>  
        </tr>
    </thead>
    <tbody style="overflow-y: scroll; height: 400px;"> 
    ';


if (($my_courses != false) || ($my_courses != null)) {
    foreach ($my_courses as $my_course) {
        $course_ids = chop((string)$my_course->course_ids, ",");
        $ids = explode(",", $course_ids);

        $num = 1;
        $total = 0;
        foreach ($ids as $id) {
            $course = new Course();
            $cs = $course->course_($id);
            $output .= ' 
                <tr>
                    <td>' . $num . '</td> 
                    <td>' . $cs->code . '</td>
                    <td> 
                    ' . $cs->title . ' 
                    <br />
                    <span class="text-danger">
                        ' . $cs->lecturer . '
                    </span>
                    </td>
                    <td> 
                        ' . $cs->unit . ' 
                    </td>
                </tr>';
            $num++;
            $total = $total + (int)$cs->unit;
        }
    }
}

$output .= '
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" class="text-right"> Total </td>
            <td>
                <?php echo $total; ?> 
            </td>
        </tr> 
    </tfoot>
</table>';

$output_array = [
    "output" => $output
];

echo json_encode($output_array);
