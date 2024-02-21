<?php
include 'header.php';
include "db_conn.php";

if(isset($_POST['deletebtn'])){

    

    $id = $_POST['id'];

    $sql = "DELETE FROM crud WHERE id = {$id}"; 
$result = mysqli_query($conn, $sql) or die("Query Unsuccessful");

header("Location: index.php?msg=Data deleted successfully");
mysqli_close($conn);


}
?>

<div id="main-content" >
    
    <form class="post-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label style="mb-5" >Id</label>
            <input type="text" name="id" />
        </div>
        <input class="submit" type="submit" name="deletebtn" value="Delete" />
    </form>
</div>
</div>
</body>
</html>