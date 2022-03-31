       
<!--Filter php-->
 <?php
 if (isset($_POST['alphabet']))
 {
     $alphabet_query = "SELECT *FROM course ORDER BY cour_name ASC ";
     $result= executeQuery($alphabet_query);
 }
 elseif (isset ($_POST['pd'])){
     $pd_query = "SELECT *FROM course ORDER BY cour_date ASC";
     $result= executeQuery($pd_query);
 }
 
 else {
$default_query = "SELECT *FROM course" ;
$result = executeQuery($default_query);
}
 function executeQuery($query)
{
$connect = mysqli_connect("localhost", "root","","learneasy");
$result = mysqli_query($connect, $query);
return $result;
}
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Filter</title>
        <link href="filter.css" rel="stylesheet" type="text/css">

    </head>
    <body>

       <!--Filter-->
        <div class="filter">
         <button class="filter-dropdown-btn">Filter
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="filter-dropdown-container">
      <form method="POST" action="index.php">
          <input type="submit" name="alphabet" value="Sort by A-Z" id="alphabet">
          <input type="submit" name="pd" value="Published Date">
      </form>
  </div>
            </div> 
          
       <!--PHP for retrieve date from database-->
          
<?php while ($res =mysqli_fetch_array($result)):{
                    $name = $res['cour_name'];
                    $category = $res['cour_category'];
                }?>
        
              
              <?php endwhile;?>
  
                
           
        

        
        
        <script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>

    </body>
</html>
