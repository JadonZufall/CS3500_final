<?php
include("inc/dbconn.php");
global $conn;
?>
<style>
    .comment {
        margin-top: 10px;
        padding: (5px, 5px, 5px, 5px);
        background-color: #444444;
    }
    .username {
        color: lightgrey;
    }
    .posttxt {
        text-indent: 30px;
        padding: 0;
    }
</style>
<div class="container">
    <?php
    if ($_SESSION['loggedin']) {
        echo 'Leave a comment:<br>';
        echo '<form action="forms/comment_post.php" method="post">';
        echo '<input type="text" name="data"><br>';
        echo '<input type="submit">';
        echo '</form>';
    }
    else {
        echo "<a href='/login'>Login</a> to leave a comment";
    }
    ?>
    <?php
        $sql = "SELECT * FROM comments ORDER BY postDate DESC";
        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $userID = $row["posterID"];
                $userlookup = $conn->query("SELECT username FROM users WHERE userID=" . $userID);
                $dblookup = $userlookup->fetch_assoc();
                $username = $dblookup['username'];
                $text = $row["commentText"];
                echo '<div class="comment">';
                echo '<p class="username">' . $username . '@' . $row['postDate'] . '</p>';
                echo '<p class="posttxt">' . $text . '</p>';
                echo '<br>';
                echo '</div>';
                
            }
            /* free result set */
            $result->free();
        }
    ?>
</div>