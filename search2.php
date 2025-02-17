<?php
require_once('db.php');

if(isset($_GET['search']) && !empty($_GET['search'])){
    $user_search = $_GET['search'];
    $search_words = explode(' ', $user_search);
    $where_clause = ' ';
    $search_conditions = array();

    foreach($search_words as $word)
    {
        $search_conditions[] = "surname LIKE '%$word%'";
    }

    $where_clause = implode(" OR ", $search_conditions);

    $search_query = "SELECT surname FROM Users";
    if(!empty($where_clause)){
        $search_query .= " WHERE $where_clause";
    }
    
    $result_search = $conn->query($search_query);

   // if($result_search->num_rows > 0){
        echo "<div class='search-results'>";
        echo "<h3>Результаты поиска по фразе:  </h3>";
        while ($row_search = $result_search->fetch_assoc()) {
            echo $row_search['surname'] . "<br>";
        }
        echo "</div>";
    //} else {
    //    echo "По вашему запросу ничего не найдено.";
//    }
}
?>
