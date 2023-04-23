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
    Leave a comment:<br>
    <form action="forms/comment_post.php" method="post">
        <input type="text" name="data"><br>
        <input type="submit">
    </form>
    <?php
        include("inc/dbconn.php");
        global $conn;
        session_start();
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