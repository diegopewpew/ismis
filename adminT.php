<div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-primary btn-lg">
    <input type="checkbox" checked="" autocomplete="off" class="btn btn-primary" data-toggle="modal" data-target="#addsubj"> Add subject
  </label>
  <label class="btn btn-primary btn-lg">
    <input type="checkbox" autocomplete="off" class="btn btn-primary" data-toggle="modal" data-target="#addsched"> Add Schedule
  </label>
  <label class="btn btn-primary btn-lg">
    <input type="checkbox" autocomplete="off" class="btn btn-primary" data-toggle="modal" data-target="#addstud"> Add Student to class
  </label>
  <label class="btn btn-primary btn-lg">
    <input type="checkbox" autocomplete="off" class="btn btn-primary" data-toggle="modal" data-target="#addclass"> Add Class
  </label>
  <label class="btn btn-warning btn-lg">
  <input type="checkbox" autocomplete="off" class="btn btn-primary" data-toggle="modal" data-target="#showsched"> show schedule
  </label>
  <label class="btn btn-warning btn-lg">
    <input type="checkbox" autocomplete="off" class="btn btn-primary" data-toggle="modal" data-target="#showstud"> Show All Student
  </label>
  <label class="btn btn-warning btn-lg">
    <input type="checkbox" autocomplete="off" class="btn btn-primary" data-toggle="modal" data-target="#showsubj"> Show Subject
  </label>
  <label class="btn btn-warning btn-lg">
    <input type="checkbox" autocomplete="off" class="btn btn-primary" data-toggle="modal" data-target="#showclass"> Show class
  </label>
</div>

<table class="table table-hover">
    <tr class="table-light">
    <th scope="row">scheduel code </th>
            <th>subject</th>
            <th> group number</th>
            <th>days of the week</th>               
            <th>start</th>        
            <th>end</th>  
            <th>teacher</th>  
            <th>studlist</th>  

            </tr>
            
            <?php
                                                    $sql = "SELECT * from schedule
                                                     ";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                          $_SESSION['id'] = $row['class_id'];
                                                          $sql2 = "SELECT * from class WHERE class_id=".$row['class_id']."";
                                                          $result2 = $conn->query($sql2);
                                                          $row2 = $result2->fetch_assoc();
                                                          $sql3 = "SELECT * from account WHERE account_id=".$row2['faculty_id']."";
                                                          $result3 = $conn->query($sql3);
                                                          $row3 = $result3->fetch_assoc();
                                                          $sql4 = "SELECT * from time WHERE time_id=".$row2['time_id']."";
                                                          $result4 = $conn->query($sql4);
                                                          $row4 = $result4->fetch_assoc();
                                                          $sql5 = "SELECT * from subjects WHERE subject_id=".$row2['subject_id']."";
                                                          $result5 = $conn->query($sql5);
                                                          $row5 = $result5->fetch_assoc();
                                                          ?>
                                                          <tr class="table-light">
                                                          <?php
                                                            echo "
                                                            
                                                                <td>".$row['schedule_id']."</td>
                                                                <td>".$row5['subject_name']."</td>
                                                                <td>".$row5['group_num']."</td>
                                                                
                                                                
                                                                <td>";
                                                                if($row4['monday']==='1'){
                                                                  echo"M ,";
                                                                }
                                                                if($row4['tuesday']==='1'){
                                                                  echo"T ,";
                                                                }
                                                                if($row4['wednesday']==='1'){
                                                                  echo"W ,";
                                                                }
                                                                if($row4['thursday']==='1'){
                                                                  echo"TH ,";
                                                                }
                                                                if($row4['friday']==='1'){
                                                                  echo"F ";
                                                                }
                                                                echo"</td>
                                                                <td>".$row4['start_time']."</td>
                                                                <td>".$row4['end_time']."</td>
                                                                <td>".$row3['fname']." ".$row3['lname']."</td>
                                                            </tr>
                                                            ";
                                                        }
                                                    } else {
                                                        echo "<td> create time first <td>";
                                                    }
                                                ?>
       
    </table> 





    <div class="modal fade" id="addsubj" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">add subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group"><br><br>
                        <form action="wazap.php" method="post">
                                <label>subject</label><br>
                                <input type="text" class="form-control" name="subject"><br><br>
                                <label>course code</label><br>
                                <input type="text" class="form-control" name="course_code"><br><br>
                                <label>group num</label><br>
                                <input type="text" class="form-control" name="groupnum"><br><br>
                                <button type="submit" name="register">Register</button>
                        </form>
                        </div>
                </div>
            </div>
        </div>
    


    <?php
         if(isset($_POST['register'])){
            
                $subject = $_POST['subject'];
                $course_code = $_POST['course_code'];
                $groupnum = $_POST['groupnum'];                                                
                $sql = "INSERT INTO subjects(subject_name, course_code, group_num)
                         VALUES('$subject', '$course_code', '$groupnum')";
                         
                if(mysqli_query($conn, $sql)){
                } else {
                    echo "Error: ".$sql."<br>".mysqli_error($conn);
                }

            }
            
        
    ?> 
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>






<div class="modal fade" id="addsched" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">add subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group"><br><br>
                        <form action="wazap.php" method="post">
                                <label for="start">Select start time:</label>
                                <input type="time" id="appt" name="start">
                                <label for="end">Select end time:</label>
    	                        <input type="time" id="appt" name="end"><br>
                                <input type="radio" id="male" name="monday" value="1">
                                <label for="male">monday</label><br>
                                <input type="radio" id="female" name="tuesday" value="1">
                                <label for="female">tuesday</label><br>
                                <input type="radio" id="female" name="wednesday" value="1">
                                <label for="female">wednesday</label><br>
                                <input type="radio" id="female" name="thurseday" value="1">
                                <label for="female">thurseday</label><br>
                                <input type="radio" id="other" name="friday" value="1">
                                <label for="other">friday</label>
                                <button type="submit" name="lol">Register</button>
                        </form>
                        </div>
                </div>
            </div>
        </div>
    


    <?php
         if(isset($_POST['lol'])){
            
                $subject = $_POST['start'];
                $course_code = $_POST['end'];
                $monday =  $_POST['monday'];    
                $tues =  $_POST['tuesday']; 
                $wednesday =  $_POST['wednesday']; 
                $thurseday =  $_POST['thurseday']; 
                $friday =  $_POST['friday'];                                           
                $sql = "INSERT INTO time (monday, tuesday, wednesday, thursday, friday, start_time, end_time) 
                VALUES (  '$monday', '$tues', '$wednesday', '$thurseday', '$friday', '$subject', '$course_code')";
                         
                if(mysqli_query($conn, $sql)){
                    echo "New record created!";
                } else {
                    echo "Error: ".$sql."<br>".mysqli_error($conn);
                }

            }
            
        
    ?> 
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="addclass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">add class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <div class="form-group"><br><br>
                        <form action="wazap.php" method="post">
                        <label for="female">time slot</label><br>
                                <select id="cars" name="time" >
                                <?php
                                                $sql = "SELECT * FROM time ";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    while($row = $result->fetch_assoc()) {
                                                        echo "
                                                        <option value=".$row['time_id'].">".$row['time_id']."</option>
                                                        ";
                                                    }
                                                } else {
                                                    echo "<td> create time first <td>";
                                                }
                                            ?>
                                </select><br>
                                <label for="female">subject_id</label><br>
                                <select id="cars" name="subject" >
                                <?php
                                                $sql2 = "SELECT * FROM subjects ";
                                                $result2 = $conn->query($sql2);

                                                if ($result2->num_rows > 0) {
                                                    while($row2 = $result2->fetch_assoc()) {
                                                        echo "
                                                        <option value=".$row2['subject_id'].">".$row2['subject_name']."</option>
                                                        ";
                                                    }
                                                } else {
                                                    echo "<td> create time first <td>";
                                                }
                                            ?>
                                </select> <br>
                                <label for="female">teacher</label><br>
                                <select id="cars" name="teacher" >
                                <?php
                                                $sql3 = "SELECT * FROM account WHERE account_type = 'faculty'";
                                                $result3 = $conn->query($sql3);

                                                if ($result3->num_rows > 0) {
                                                    while($row3 = $result3->fetch_assoc()) {
                                                        echo "
                                                        <option value=".$row3['account_id'].">".$row3['fname']." " .$row3['lname']."</option> ";
                                                    }
                                                } else {
                                                    echo "<td> create time first <td>";
                                                }
                                            ?>
                                </select> <br>

                                                




                                <button type="submit" name="reg">Register</button>
                        </form>
                        </div>
                </div>
            </div>
        </div>
    


    <?php
         if(isset($_POST['reg'])){
            
                $subject = $_POST['time'];
                $course_code = $_POST['subject'];
                $monday =  $_POST['teacher'];                                       
                $sql = "INSERT INTO  class(time_id, subject_id, faculty_id) 
                VALUES (  '$subject', '$course_code', '$monday')";
                         
                if(mysqli_query($conn, $sql)){
                    echo "New record created!";
                } else {
                    echo "Error: ".$sql."<br>".mysqli_error($conn);
                }

            }
            
        
    ?> 
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>












    <div class="modal fade" id="showstud" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">all students</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <table class="table table-hover">
        <tr class="table-active">
            <th scope="row">id</th>
            <th>firstname</th>
            <th>lastname</th>
            <th>address</th>
            <th>email</th>
        </tr>
        <?php
            $sql = "SELECT * FROM account WHERE account_type = 'student'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>".$row['account_id']."</td>
                            <td>".$row['fname']."</td>
                            <td>".$row['lname']."</td>
                            <td>".$row['address']."</td>
                            <td>".$row['email']."</td>
                            <td>
                            </td>
                        </tr>
                    ";
                }
            } else {
                echo "<td> create subject first <td>";
            }
        ?>
      
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="showsched" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">all students</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <table class="table table-hover">
        <tr class="table-active">
            <th scope="row">id</th>
            <th>M</th>
            <th>T</th>
            <th>W</th>
            <th>TH</th>
            <th>F</th>
            <th>start</th>
            <th>end</th>
        </tr>
        <?php
            $sql = "SELECT * FROM time ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>".$row['time_id']."</td>
                            <td>".$row['monday']."</td>
                            <td>".$row['tuesday']."</td>
                            <td>".$row['wednesday']."</td>
                            <td>".$row['thursday']."</td>
                            <td>".$row['friday']."</td>
                            <td>".$row['start_time']."</td>
                            <td>".$row['end_time']."</td>
                            <td>
                            </td>
                        </tr>
                    ";
                }
            } else {
                echo "<td> create subject first <td>";
            }
        ?>
      
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="showsubj" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">all students</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <table class="table table-hover">
        <tr class="table-active">
            <th scope="row">id</th>
            <th>subject</th>
            <th>course code</th>
            <th>group num</th>
        </tr>
        <?php
            $sql = "SELECT * FROM subjects ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>".$row['subject_id']."</td>
                            <td>".$row['subject_name']."</td>
                            <td>".$row['course_code']."</td>
                            <td>".$row['group_num']."</td>
                            
                            <td>
                            </td>
                        </tr>
                    ";
                }
            } else {
                echo "<td> create subject first <td>";
            }
        ?>
      
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>








<div class="modal fade" id="showclass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">all students</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            
      <table class="table table-hover">
        <tr class="table-active">
            <th scope="row">id</th>
            <th>subject</th>
            <th>course code</th>
            <th>group num</th>
            <th>faculty</th>
        </tr>
        <?php
            $_SESSION['temporary'] = $_POST['temp'];
            $sql = "SELECT * FROM class ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $sql5 = "SELECT * from subjects WHERE subject_id=".$row['subject_id']."";
                  $result5 = $conn->query($sql5);
                  $row5 = $result5->fetch_assoc();
                  $sql6 = "SELECT * from time WHERE time_id=".$row['time_id']."";
                  $result6 = $conn->query($sql5);
                  $row6 = $result6->fetch_assoc();
                  $sql7 = "SELECT * from account WHERE account_id=".$row['faculty_id']."";
                  $result7 = $conn->query($sql7);
                  $row7 = $result7->fetch_assoc();
                    echo "
                    <tr>
                    <td>".$row['class_id']."</td>
                    <td>".$row5['subject_name']."</td>
                    <td>".$row5['course_code']."</td>
                    <td>".$row5['group_num']."</td>
                    <td>".$row7['fname']." ".$row7['lname']."</td>
                </tr>
                    ";
                }
            }
        ?>
        <select id="cars" name="temp" >
        
        
        
        
        <label class="btn btn-warning btn-lg">
        <input type="checkbox" autocomplete="off" class="btn btn-primary" data-toggle="modal" data-dismiss="modal" data-target="#showsubj"> Show class
        </label>
    
      
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>






<div class="modal fade" id="showsubj" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">all students</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <table class="table table-hover">
        <tr class="table-active">
            <th scope="row">id</th>
            <th>subject</th>
            <th>course code</th>
            <th>group num</th>
        </tr>
        <?php
            $sql = "SELECT * FROM subjects ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>".$row['subject_id']."</td>
                            <td>".$row['subject_name']."</td>
                            <td>".$row['course_code']."</td>
                            <td>".$row['group_num']."</td>
                            
                            <td>
                            </td>
                        </tr>
                    ";
                }
            } else {
                echo "<td> create subject first <td>";
            }
        ?>
      
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>