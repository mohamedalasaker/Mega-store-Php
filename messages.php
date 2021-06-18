<?php 
$title = 'messages';
require_once 'templates/header.php';
require_once 'classes/User.php';
require_once 'templates/nav-bar.php';
require_once 'config/connection.php';
        
$user = new User;
if(!$user->isAdmin()){
    header("location:index.php");
}

    $sql = $conn->prepare("SELECT * , m.id as message_id,s.id as service_id FROM messages m left JOIN services s on m.service_id = s.id order by m.id");
    
        
    $sql->execute();
    
    $messages = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    

    if(isset($_POST['delete_button'])){
        $sql->prepare("DELETE from messages where id = ?");
        
        $sql->bind_param('i',$messageId);
        
        $messageId = $_POST['delete_message'];
        
        $sql->execute();

        $sql->close();
        header('location:messages.php');
        die();
    };
   
    if(!isset($_GET['id'])){
?>

<h2 class="my-3 text-center">Recived messages</h2>
<div class="table-responsive" style="padding-bottom: 100px">
    <table class="table table-hover table-striped">
        <tr>
            <th>Id</th>
            <th>Snder Name</th>
            <th>Sender Email</th>
            <th>Service</th>
            <th>Document</th>
            <th>Actions</th>
        </tr>
        <?php foreach($messages as $message){ ?>
            <tr>
                <td><?php echo htmlspecialchars($message['message_id']) ?></td>
                <td><?php echo htmlspecialchars($message['contact_name']) ?></td>
                <td><?php echo htmlspecialchars($message['email']) ?></td>
                <td><?php echo htmlspecialchars($message['name']) ?></td>
                <td><?php echo htmlspecialchars($message['document']) ?></td>
                <td>
                    <a href="?id=<?php echo $message['message_id'] ?>" class="btn btn-primary btn-sm">View</a>
                    <form onsubmit="return confirm('are u sure you eant to delete a message?')" action="" method="POST" style="display: inline-block;">
                        <input type="hidden" name='delete_message' value="<?php echo $message['message_id'] ?>" >
                        <input type="hidden" name='delete_file' >
                        <button class="btn btn-sm btn-danger" name="delete_button">Delete</button>
                    </form>
                </td>
                
            </tr>

        <?php }?>    

    </table>
</div>
    <?php }else{ 
        
               $sql = $conn->prepare("select *,m.describtion as message_describtion, m.id as message_id , s.id as service_id, s.describtion as service_describtion  from messages m left join services s on m.service_id = s.id  where m.id=? ");
               $sql->bind_param('i',$messageId);
               $messageId = $_GET['id'];
               $sql->execute();
               $message = $sql->get_result()->fetch_array(MYSQLI_ASSOC);
               $sql->close();

        
                
   
    ?>
    <div class="container" style="min-height: 300px;">
        <div class="row">
            <div class="col-8 offset-2">
                <div class=" card">
                    <div class="card-header">
                         <h3>Message From :<?php echo $message['contact_name'] ?> </h3>
                         <p class="small"> Email: <?php echo $message['email'] ?></p>
                    </div>
                    <div class="card-body">
                        <h5>Service : <?php echo $message['name'] ? $message['name'] :  'No service' ?> </h5>
                        <?php echo $message['message_describtion'] ?>
                    </div>

                    <?php if($message['document']){ ?>
                            <div class="card-footer">
                               Attachment : <a href="<?php echo $config['app_url'] . $message['document'] ?>">Download document</a>
                            </div>
                    <?php } ?>   
                </div>

            </div>
        </div>
    </div>
        
        
    <?php } ?>




<?php
require_once 'templates/footer.php';