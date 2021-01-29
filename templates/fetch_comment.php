<?php

//fetch_comment.php

$connect = new PDO('mysql:host=localhost;dbname=testing', 'root', '');

$query = "
SELECT * FROM tbl_comment 
WHERE parent_comment_id = '0' 
ORDER BY comment_id DESC
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
 $output .= '
 <div style="background-color: white; border: 1px solid lightgrey; border-radius: 5px; margin: 10px auto; width: 700px; height: auto;">
    <div style="background-color: #eeeeee; border: 1px solid lightgrey; text-align: left; border-radius-top-left: 5px; border-radius-top-right: 5px; padding: 5px; width: 700px; color: #222831">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
    <div class="panel-body" style="text-overflow: clip; text-align: left; padding: 10px; font-family: courier new; font-size: 15px;">'.$row["comment"].'</div>
    <div class="panel-footer" align="right" style="background-color: #eeeeee; padding: 10px;"><button type="button" class="btn btn-outline-secondary reply" id="'.$row["comment_id"].'">Reply</button></div>
 </div>
 ';
 $output .= get_reply_comment($connect, $row["comment_id"]);
}

echo $output;

function get_reply_comment($connect, $parent_id = 0, $marginleft = 220)
{
 $query = "
 SELECT * FROM tbl_comment WHERE parent_comment_id = '".$parent_id."'
 ";
 $output = '';
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div style="background-color: white; border: 1px solid lightgrey; border-radius: 5px; margin-top: 10px; margin-bottom: 10px; margin-left:'.$marginleft.'px; width: 700px; height: auto;">
    <div style="background-color: #eeeeee; border: 1px solid lightgrey; text-align: left; border-radius-top-left: 5px; border-radius-top-right: 5px; padding: 5px; width: 700px; color: #222831">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
    <div class="panel-body" style="text-overflow: clip; text-align: left; padding: 10px; font-family: courier new; font-size: 15px;">'.$row["comment"].'</div>
    <div class="panel-footer" align="right" style="background-color: #eeeeee; padding: 10px;"><button type="button" class="btn btn-outline-secondary reply" id="'.$row["comment_id"].'">Reply</button></div>
   </div>
   ';
   $output .= get_reply_comment($connect, $row["comment_id"], $marginleft);
  }
 }
 return $output;
}

?>
