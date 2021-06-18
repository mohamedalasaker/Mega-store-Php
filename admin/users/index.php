<?php 
$title = 'Users';
$icon = 'fa fa-users';
include __DIR__.'/../../config/connection.php';

if(isset($_POST['name'])){
    $txt =  $_POST['name'];
    $usersMin = $conn->query(" select * from users where email like'%$_POST[name]%'")->fetch_all(MYSQLI_ASSOC);
    print_r($usersMin);
    return false;
}else{
    $users = $conn->query(" select * from users order by id")->fetch_all(MYSQLI_ASSOC);
}
// if(isset($usersMin)){
//     die('aha');
// }
include __DIR__.'/../templates/header.php';




if(isset($_POST['delete_button'])){

    $sql = $conn->prepare("DELETE from users where id = ?");
        
    $sql->bind_param('i',$userId);
    
    $userId = $_POST['delete_user'];
    
    $sql->execute();

    $sql->close();
    echo '<script>location.href="index.php" </script>';

}

?>


<?php if(!count($users)): ?>
    <h1 class="text-center" style="color:#a9a9a9;">there is no users</h1>
    <?php  else : ?>   
        
        <div class="card table-responsive" style="margin-bottom: 100px;">
            
            <h4 class="text-center">There is  <?php echo count($users) ?> users</h4>
            <input type="text" id="search" name="" style="width: 50%;" class="mx-auto form-control">
            <p id="test"></p>
            <script>
                $(document).ready(function(){
                    $('#search').keyup(function(){
                    let txt = $('#search').val();
                        $.ajax({
                            url : 'index.php',
                            method : 'POST',
                            data : {name:txt},
                            success : function(data){
                                $("#test")(data)
                            },
                            error : function(err){
                                console.log(err);
                            }
                        })
                    })

                })
            </script>
            <table class="table table-hover table-striped" >
            <thead>
                <tr>
                    <th width="0">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th width="0px">Role</th>
                    <th width="50px">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user){ ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']) ?></td>
                        <td><?php echo htmlspecialchars($user['name']) ?></td>
                        <td><?php echo htmlspecialchars($user['email']) ?></td>
                        <td><?php echo htmlspecialchars($user['role']) ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $user['id'] ?>" class="btn btn-warning btn-sm" style="margin-right: 10px;">Edit</a>
                            <form  action="" method="POST" style="display: inline-block;">
                                <input type="hidden" name='delete_user' value="<?php echo $user['id'] ?>" >
                                <button onclick="return confirm('Are u sure ?')" class="btn btn-sm btn-danger" name="delete_button">Delete</button>
                            </form>
                        </td>
                        
                    </tr>
        
                <?php }?>    
            </tbody>

            </table>
</div>


<?php
endif;
include __DIR__.'/../templates/footer.php';

?>