<?php

    require("connection.php");

    $data = array();
    $from_date = "1900-00-00";
    $to_date = "3000-00-00";
    
    $id = ($_POST['action'] * 10) - 10;

    if(isset($_POST['from_date']) AND ($_POST['from_date']) != "")
    {
        $from_date = $_POST['from_date'];
    }  
    if(isset($_POST['to_date']) AND ($_POST['to_date']) != "")
    {
        $to_date = $_POST['to_date'];
    }
    
    $amount = "SELECT count(*) AS count FROM leads 
    WHERE (first_name LIKE '{$_POST['name']}%' OR last_name LIKE '{$_POST['name']}%') AND (registered_datetime BETWEEN '{$from_date}%' AND '{$to_date}%')";

    $query = "SELECT * FROM leads 
    WHERE (first_name LIKE '{$_POST['name']}%' OR last_name LIKE '{$_POST['name']}%') AND (registered_datetime BETWEEN '{$from_date}%' AND '{$to_date}%') ORDER BY last_name LIMIT {$id}, 10";

   $users = fetch_all($query);

   $amount_of_pages = fetch_record($amount);

   $total = ceil($amount_of_pages['count'] / 10);

   $page = "<ul id='pages'>";
   for($i = 1; $i <= $total; $i++)
   {
       $page .= "<li style='display: inline;'><button type='button' id='{$i}' class='btn btn-link'>{$i}</button></li>";
   }
   $page .= "</ul>";

   $html = "
        <table class='table'>
            <thead>
                <tr>
                   <th>leads_id</th>
                   <th>first_name</th>
                   <th>last_name</th>
                   <th>registered_datetime</th>
                   <th>email</th>
                </tr>
            </thead>
            <tbody>
        ";
  foreach($users as $user)
  {
        $html .= "
                <tr>
                    <td>{$user['leads_id']}</td>
                    <td>{$user['first_name']}</td>
                    <td>{$user['last_name']}</td>
                    <td>{$user['registered_datetime']}</td>
                    <td>{$user['email']}</td>
                </tr>
        ";
  }

  $html .= "
            </tbody>
        </table>
    ";

    $data['pages'] = $page;
    $data['html'] = $html;
    echo json_encode($data);

?>