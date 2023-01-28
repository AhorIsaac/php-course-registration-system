<?php
require_once("../classes/CourseRegistration.php");
?>

<h3> <i class="fa fa-users fa-1x text-success"></i> Students </h3>
<table class="table table-striped table-hover">
    <thead class="bg-success">
        <tr>
            <th> Registration Number </th>
            <th> Fullname </th>
            <th> Level </th>
            <th> Details </th>
            <th> Action </th>
            <th> Date </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $course_registration = new CourseRegistration();
        $course_registrations = $course_registration->course_registrations();

        if (($course_registrations != false) || ($course_registrations != null)) {
            foreach ($course_registrations as $course_registration) {
        ?>
                <tr>
                    <td> <?php echo $course_registration->cos_reg_num; ?> </td>
                    <td> <?php echo $course_registration->cos_reg_fullname; ?> </td>
                    <td> <?php echo $course_registration->cos_reg_level; ?> </td>
                    <td>
                        <a href='#' class="btn btn-info btn-sm" id="get_course_reg_details" value="<?php echo $course_registration->cos_reg_id; ?>">
                            Details
                        </a>
                    </td>
                    <td>
                        <span class="text-secondary">
                            <?php
                            if ($course_registration->cos_reg_stat == 0) {
                            ?>
                                <a href='#' class="btn btn-info btn-sm" id="approve_course_reg" value="<?php echo $course_registration->cos_reg_id; ?>">
                                    Approve
                                </a>
                            <?php
                            } else {
                            ?>
                                <a href='#' class="btn btn-success btn-sm disabled">
                                    Approved
                                </a>
                            <?php
                            }
                            ?>
                        </span>
                    </td>
                    <td>
                        <span class="text-warning font-weight-bodld">
                            <?php
                            echo $course_registration->cos_reg_date
                            ?>
                        </span>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
    <tfoot>
    </tfoot>
</table>