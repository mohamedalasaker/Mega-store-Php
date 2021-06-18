<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
<script>
// Add the following code if you want the name of the file appear on select


// taken from w3school 

$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});



</script>




<footer class="text-center bg-dark text-white row" id="footer" style="position:relative; bottom:0px; min-height:100px">
    
        <div class="col-4">
            <a style="color: white;" href="https://twitter.com/mohamedalasaker"><p><img src="http://localhost/study/mega%20store/imgs/download.png" style="width:30px; height:30px;" alt="linked in"> mohamed as7</p></a>
        </div>
        <div class="col-4">
            <div> 
                <p>
                    copyrights to <span style="color: orange;"> mohamed </span> @ at <?php echo $config['app_date']; ?> 
                </p> 
            </div>
        </div>
        <div class="col-4">
            <a style="color: white;" href="https://sa.linkedin.com/in/mohamed-as7-690443195"><p><img src="http://localhost/study/mega%20store/imgs/174857.png" style="width:30px; height:30px;" alt="twitter"> mohamedalasaker</p></a>
        </div>
   
</footer>
<?php 
if( isset($_SESSION["is_logged"]) || !isset($_SESSION['is_logged']) || isset($_SESSION['product_added'])){
    echo "
    <script>
    let alertBox = document.getElementById('logged_in');
        alertBox.style.display = 'block';
        setTimeout(function(){
            alertBox.style.display = 'none';
        },4000)
    </script>
    ";
   
}
?> 

</body>
    



</html>