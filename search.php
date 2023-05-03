<?php 
    include 'db.php';
    if(isset($_POST['input'])){
        $input = $_POST['input'];
        $sql = "Select * from song where songname like '%{$input}%'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
           while($data = mysqli_fetch_assoc($result)){?>
            <table><tr><?php echo $data['songname']?></tr></table>
        <?php }
        }
        else{
            echo "<span class = 'text-danger'> No data found </span>";
        }
    }
?>