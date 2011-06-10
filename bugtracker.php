<?php include('header.php');?>
<?php 
	$project = $auth->selProject;

	$selectedBuglist;
	if (isset ($_GET['blid'])) {
		$selectedBuglistID = $_GET['blid'];
		$selectedBuglist = new Buglist();
		$selectedBuglist->getByID($selectedBuglistID);
	} else {
		$selectedBuglist = $project->getFavoriteBuglist();
	}
	
	
?>
<div id="hard-facts-wrapper">
	<div id="hard-facts">
		<div class="hard-headline">
			<img src="./img/tasks.png">
			<h1>Bugtracker</h1>
		</div>
		<div id="bugtracker-boxes">
			<div class="box-finished">
				<?php echo $project->getNumFinishedBugs(); ?> Abgeschlossene
			</div>
			<div class="box-pending">
				<?php echo $project->getNumPendingBugs(); ?> Ausstehende
			</div>
			<div class="box-assigned">
				564 Zugewiesene
			</div>
		</div>
	</div>
</div>
<div id="wrapper">
	<div id="content">
		<div id="tracker-header">
			<h2>Neue Einträge in: <?php echo $selectedBuglist->bugl_name;?></h2>
		</div>
		<div id="tracker-side">
			<ul>
				<?php 
					$buglists = $project->getBuglists();
					foreach($buglists as $buglist) {
						if ($buglist == $selectedBuglist) {
							//Buglist is selected
							echo "<li>";
							echo "<a href=bugtracker.php?pid=" . $auth->selProject->pr_id . "&blid=" . $buglist->bugl_id . ">" . $buglist->bugl_name . "</a></li>";
						} else {
							//not
							echo "<li class='selected'>";
							echo "<a href=bugtracker.php?pid=" . $auth->selProject->pr_id . "&blid=" . $buglist->bugl_id . ">" . $buglist->bugl_name . "</a></li>";
						}
					}
				?>
			</ul>
		</div>
		<div id="tracker-content">
			<div id="tracker-post">
				<div class="track-header">
					<div class="button-new">
						<a href="bug-new.php">+</a>
					</div>
					<div class="sort">
						<p>Sortieren nach:</p>
						<form action="" method="GET">
							<select name="">
								<option>ID</option>
								<option>Datum</option>
								<option>Status</option>
							</select>
						</form>
					</div>
				</div>
				<?php 
				$bugs = $selectedBuglist->getBugs(0, 1);
				foreach($bugs as $bug) {
				?>
				<div class="track-id">
					<table>
						<th>ID:</th>
						<th>Ersteller:</th>
						<th>Name:</th>
						<th></th>
							<tr>
							<?php
							$account = new Account();
							$account->getByID($bug->ac_idCreator);
							echo "<td>#$bug->bug_id</td>";
							echo "<td>$account->ac_firstname $account->ac_lastname</td>";
							echo "<td>$bug->bug_name";
						?>
						</tr>
					</table>
				</div>
				<?php } //end foreach($bugs as $bug)?>
			</div>
		</div>
	</div>
</div>
<?php include('footer.php');?>
