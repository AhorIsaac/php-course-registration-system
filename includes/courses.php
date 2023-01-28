<?php
require_once("../classes/Course.php");

?>

<div class="row justify-content-center">
    <div class="col-md-3 col-sm-3 col-lg-3">
        <div class="card mt-5 shadow bg-transparent">
            <div class="card-header bg-success">
                <h3 class="course-heading"> Add Course </h3>
            </div>
            <div class="card-body">
                <form action="../controllers/CourseController.php" method="POST">
                    <div class="form-group">
                        <label for="reg_num"> Course Title </label>
                        <input type="text" class="form-control border" id="title" name="title" required />
                    </div>
                    <div class="form-group">
                        <label for="reg_num"> Course Code </label>
                        <input type="text" class="form-control border" id="code" name="code" required />
                    </div>
                    <div class="form-group">
                        <label for="reg_num"> Credit Unit </label>
                        <input type="text" class="form-control border" id="unit" name="unit" required />
                    </div>
                    <div class="form-group">
                        <label for="reg_num"> Lecturer </label>
                        <input type="text" class="form-control border" id="lecturer" name="lecturer" required />
                    </div>
                    <div class="form-group">
                        <label for="reg_num"> Level </label>
                        <select class="form-control border" id="level" name="level" required>
                            <option value="" selected> Choose Level </option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="300">300</option>
                            <option value="400">400</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-outline-dark btn-md" type="reset" name="reset" value="Reset" />
                        <input class="btn btn-success btn-md" type="submit" name="add_course" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8 col-sm-8 col-lg-8">
        <div class="card mt-5 shadow bg-transparent">
            <div class="card-header bg-success">
                <h3 class="course-heading"> List of all courses </h3>
            </div>
            <div class="card-body" style="overflow-y: scroll; height: 540px;">
                <table class="table table-striped table-hover">
                    <thead class="bg-secondary">
                        <tr>
                            <th> Title </th>
                            <th> Code </th>
                            <th> Unit </th>
                            <th> Lecturer </th>
                            <th> Level </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $course = new Course();
                        $courses = $course->courses();

                        if (($courses != false) || ($courses != null)) {
                            foreach ($courses as $cs) {
                        ?>
                                <tr>
                                    <td> <?php echo $cs->title; ?> </td>
                                    <td> <?php echo $cs->code; ?> </td>
                                    <td> <?php echo $cs->unit; ?> </td>
                                    <td> <?php echo $cs->lecturer; ?> </td>
                                    <td> <?php echo $cs->level; ?> </td>
                                    <td>
                                        <a href="#" id="cs_vw" class="btn btn-info btn-sm m-1" value="<?php echo $cs->id; ?>">
                                            View
                                        </a>
                                        <a href="#" id="cs_upd" class="btn btn-warning btn-sm m-1" value="<?php echo $cs->id; ?>">
                                            Update
                                        </a>
                                        <a href="#" id="cs_del" class="btn btn-danger btn-sm m-1 cs_del" value="<?php echo $cs->id; ?>">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>