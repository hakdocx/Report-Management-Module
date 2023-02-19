<?php

$connection = mysqli_connect("localhost:3308","root","","databasey");
    ?>

<html>
    <body>

    <br> 
    <br>

    <center> <h3 class="initial"> <b> <u> Report Management Module </u> </b> </h3> </center>
    <hr/>
    <center> <h5> <i> <a href="#" onclick="window.print();">Print</a> </center> </i> </h5>
    <center> <h4 class="second"><i> <b> Searching course information by title </b> </i>  </h4> </center>

     <div class= "main"> 
        <form method="get">
        <?php
        $sql =mysqli_query($connection, "SELECT * FROM `course`") or die (mysqli_error($connection));

        echo "<select name= 'courseid'>";
        while($row = mysqli_fetch_array($sql))
        {
            echo "<option value='{$row['course_id']}'>{$row['course_title']}</option>";
        }

        echo "</select>";

        ?>

        <input type="submit" value="search">

    </div>
        </form>
        <?php

        if(isset($_GET['courseid']))
        {
        $courseid = $_GET['courseid'];
        $course = mysqli_query ($connection, "SELECT * FROM `registration_course` where course_id ='{$courseid}'");
        $count = mysqli_num_rows($course); 
        echo "<table border='2' align='center'>";
        echo "<tr>";
        echo "<th>  Course Registration ID  </th>";
        echo "<th>  Course ID  </th>";
        echo "<th>  Instructor ID </th>";
        echo "<th>  Opening Date  </th>";
        echo "<th>  Closing Date  </th>";
        echo "<th>  Rank  </th>";
        echo "</tr>";


        while ($row = mysqli_fetch_array($course)) {
            $cs = mysqli_query($connection,"SELECT * FROM `pool_instructor_details`");
            $studentq = mysqli_fetch_array($cs);
        
            echo "<tr>";
            echo "<td>{$row['course_reg_id']}</td>";
            echo "<td>{$row['course_id']}</td>";
            echo "<td>{$row['instructor_id']}</td>";
            echo "<td>{$row['opening_date']}</td>";
            echo "<td>{$row['closing_date']}</td>";
            echo "<td>{$studentq['rank']}</td>";
            echo "</tr>";
        }
        echo "</table>";
		
        }
            ?>
                        <br> <br> <br>            <br> <br> <br>
         <center> <h4> <i> <b> Searching account details by account id </b> </i>  </h4> </center>


<form method="get">
<?php
$sql1 =mysqli_query($connection, "SELECT * FROM `account_details`") or die (mysqli_error($connection));

echo "<select name= 'accountid'>";
while($row1 = mysqli_fetch_array($sql1))
{
    echo "<option value='{$row1['account_id']}'>{$row1['lastname']}</option>";
}

echo "</select>";

?>

<input type="submit" value="search">


</form>

<a href="#" onclick="window.print();">Print</a>
<?php

if(isset($_GET['accountid']))
{

$accountidd = $_GET['accountid'];
$account = mysqli_query ($connection, "SELECT * FROM `account_details` where account_id ='{$accountidd}'");
$count = mysqli_num_rows($account);

echo "<br/> $count Account Information Found";
echo "<table border='2' align='center'>";
echo "<tr>";
echo "<th>  Account Id  </th>";
echo "<th>  Username   </th>";
echo "<th>  User Type </th>";
echo "<th>  Last name  </th>";
echo "<th>  First Name  </th>";
echo "<th>  Middle Name </th>";
echo "<th>  Suffix </th>";
echo "</tr>";

while ($row1 = mysqli_fetch_array($account)) {
    $cs = mysqli_query($connection,"SELECT rank FROM `student`");
    $studentq = mysqli_fetch_array($cs);

    echo "<tr>";
    echo "<td>{$row1['account_id']}</td>";
    echo "<td>{$row1['username']}</td>";
    echo "<td>{$row1['user_type']}</td>";
    echo "<td>{$row1['lastname']}</td>";
    echo "<td>{$row1['firstname']}</td>";
    echo "<td>{$row1['middlename']}</td>";
    echo "<td>{$row1['suffix']}</td>";
    echo "</tr>";

}
echo "</table>";
}

?>

        </body>
        </html>


        