<?php
session_start();
require 'db.php';
?>

<?php
	function timeSince($time) {
		$time = time() - $time; // This is to get the time since that moment or whatever, I really do not know what the orginal forker means by last momment.
	$time = ($time<1)? 1 : $time;
		$tokens = array (31536000 => 'year', 2592000 => 'month', 604800 => 'week', 86400 => 'day', 3600 => 'hour', 60 => 'minute', 1 => 'second');
		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>ClassicIt</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
	<meta name="description" content="Old Reddit Revival" />
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="stylesheet" href="styles/style.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> <!-- TODO: - Make this a local resource rather than external -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>




<div class="menu">

	<?php
     if (isset($_SESSION['logged_in'])) {
    echo '<a id="menu-link" href="#">browse</a>';
    echo '<a id="menu-link" href="/submit.php">submit</a>';
    echo '<a id="menu-link" href="#">faq</a>';
	echo '<a id="menu-link" href="logout.php">logout</a>';
    } else {

		echo 'want to join? register in seconds |';
		echo '<a id="menu-link" href="/register">register</a>';
		echo '<a id="menu-link" href="/">browse</a>';
		echo '<a id="menu-link" href="/submit">submit</a>';
		echo '<a id="menu-link" href="/help">faq</a>';
    }
    ?>
  </div>

  <div id="topstrip">
  <a class="sel-menu-item" href="/web/20050809014858/http://reddit.com/hot">hottest</a>
  <a class="menu-item" href="/web/20050809014858/http://reddit.com/new">newest</a>
  <a class="menu-item" href="/web/20050809014858/http://reddit.com/prom">recently promoted</a>
  <a class="menu-item" href="/web/20050809014858/http://reddit.com/pop">top all-time</a>
  </div>


  	</div>

	<div class="content-container">
		<?php
		$link = mysqli_connect("localhost", "root", "tBFO6DH@", "classicit");
		$query = "SELECT id, username, news, ts, score, title, upvotes, downvotes FROM news ORDER BY log10(abs(upvotes-downvotes) + 1)*sign(upvotes-downvotes)+(unix_timestamp(ts)/300000) DESC";
		$result = mysqli_query($link, $query);
		if ($link === false) {
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}
		if(mysqli_query($link, $query)) {
			while ($row = mysqli_fetch_array($result)) {
				$id = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
				$username = htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8');
				$score = htmlspecialchars($row['score'], ENT_QUOTES, 'UTF-8');
				$title = htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
				$score = htmlspecialchars($row['score'], ENT_QUOTES, 'UTF-8');
				echo '<div class="row" id="post_' . $id  . '"' . '><div class="score-container"><form method="POST" id="votearrow"' . '"><input name="updoot" class="upvoteinput" type="image" id="updoot-';
				echo $id  . '" value="updoot" src="images/upvote.gif"/></form><span class="score">' . $score . '</span><form method="post" id="votearrow"><input name="downdoot" class="upvoteinput" type="image" id="downdoot-';
				echo $id . '" value="downdoot" src="images/downvote.gif"/></form></div><div class="post-container"><a href="viewpost.php?postid=' . $id . '">' . $title . '</a><p id="submission-info">
				<i class="fa fa-user"></i> submitted by <a href="?profile=' . $username . '">' . $username . '</a> <i class="fa fa-calendar"></i> ';
				echo timeSince(strtotime($row['ts'])) . ' ago, <a href="viewpost.php?postid=' . $id  . '"> add a comment</a></p></div></div>';
			}
		} else {
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
		$id = $row['id'];
		?>
		<?php if (isset($_SESSION['uname'])) { echo "<input type='hidden' id='username' value='".$_SESSION['uname']."'/>"; }?>
		<script>
		$(document).ready(function() {
			$('.upvoteinput').click(function() {
				var id2 = $(this).attr('id');
				var id = id2.substr(id2.indexOf("-") + 1);
				var username = $('#username').val();
				if (username == null) {
					return false;
				}
				var votevalue = 0;
				if (id2.startsWith("updoot")) votevalue = 1;
				if (id2.startsWith("downdoot")) votevalue = -1;
				$.ajax({
					type: "POST",
					url: "vote.php?postid=" + id + "&username=" + username +"&vote=" + votevalue,
					data: "",
					success: function(msg){},
					error: function(msg){}
				});
			});
		});
		</script>
	</div>
</body>
</html>


