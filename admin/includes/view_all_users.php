 <table class="table table-bordered table-hover">
     <thead>
         <tr>
             <th>id</th>
             <th>username</th>
             <th>firstname</th>
             <th>lastname</th>
             <th>email</th>
             <th>image</th>
             <th>role</th>
             <th>admin</th>
             <th>subscriber</th>



         </tr>
     </thead>
     <tbody>
         <?php
            $query = "SELECT * FROM users ORDER BY user_id DESC";
            $res = mysqli_query($conn, $query);

            if (!$res) {
                die("query failed" . mysqli_error($conn));
            }

            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['user_id'];
                $username = $row['user_name'];
                $fname = $row['user_firstname'];
                $lname = $row['user_lastname'];
                $email = $row['user_email'];
                $img = $row['user_image'];
                $role = $row['user_role'];


            ?>
             <tr>
                 <td><?php echo $id; ?></td>
                 <td><?php echo $username; ?></td>
                 <td><?php echo $fname; ?></td>
                 <td><?php echo $lname; ?></td>
                 <td><?php echo $email; ?></td>
                 <td><?php echo "<img class='img-responsive' src='../images/$img' />"; ?></td>
                 <td><?php echo $role; ?></td>
                 <td><a href="users.php?admin=<?php echo $id; ?>">ADMIN</a></td>
                 <td><a href="users.php?subscriber=<?php echo $id; ?>">SUBSCRIBER</a></td>
                 <td><a href="users.php?delete=<?php echo $id; ?>">🗑️</a></td>
                 <td><a href="users.php?source=edit_user&user_id=<?php echo $id; ?>">📝</a></td>

             </tr>
         <?php
            }
            ?>

     </tbody>
 </table>

 <?php
    if (isset($_GET['delete'])) {
        if (isset($_SESSION['user_role'])) {

            if ($_SESSION['user_role'] == 'admin') {

                $id = mysqli_real_escape_string($conn,$_GET['delete']);

                $query = "DELETE FROM users WHERE user_id = $id";

                $res = mysqli_query($conn, $query);

                if (!$res) {
                    die(mysqli_error($conn));
                }

                header("Location: users.php");
            }
        }
    }


    ?>

 <?php
    if (isset($_GET['admin'])) {
        $user_id = $_GET['admin'];
        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $user_id";
        $res = mysqli_query($conn, $query);
        header("Location: users.php");
    }
    ?>

 <?php
    if (isset($_GET['subscriber'])) {
        $user_id = $_GET['subscriber'];
        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $user_id";
        $res = mysqli_query($conn, $query);
        header("Location: users.php");
    }
    ?>