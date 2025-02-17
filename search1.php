<?php
    require_once('db.php');

    if(isset($_GET['search']) && !empty($_GET['search'])){
        $user_search = $_GET['search'];

        // Выполняем поиск по фамилиям пользователей
        $query_usersearch = "SELECT surname FROM Users WHERE surname LIKE '%$user_search%'";
        $result_usersearch = $conn->query($query_usersearch);

        
        echo "<div class='search-results'>";
        echo "<h3>Результаты поиска по фамилиям: </h3>";
        while ($row_usersearch = $result_usersearch->fetch_assoc()) {
            echo $row_usersearch['surname'] . "<br>";
        }
        echo "</div>";
        
    }

    ?>