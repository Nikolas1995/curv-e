<?php include('header.php');?>
<div id="hard-facts-wrapper">
	<div id="hard-facts">
		<div class="hard-headline">
			<img src="./img/tasks.png">
			<h1>Bugtracker</h1>
		</div>
			</div>
		</div>
<div id="wrapper">
	<div id="content">
		<div id="tracker-header">
			<h2>Neuen Bug erstellen</h2>
		</div>
		<div id="tracker-left">
			<div class="bug-details">
				<h2>Typ:</h2>
				<form action="">
				<p><input type="radio" name="type" value="design">Design</p>
				<p><input type="radio" name="type" value="code">Code</p>
				<p><input type="radio" name="type" value="marketing">Marketing</p>
				
				<div>
					<h2>Zuweisen:</h2>
					<div class="bug-give">
						<input class="hurensohn" name="give" type="text" value="Marcus Bunte">
						<img class="bug-give-img" src="./img/avatar/zuweisung.png">
					</div>
				</div>
				<div>
				<h2>Reproduzierbar</h2>
				<p><input type="radio" name="reproduce" value="yes">Ja</p>
				<p><input type="radio" name="reproduce" value="no">Nein</p>
				</div>
			 </div>
		</div>
		<div id="tracker-right">
			<div class="bug-new-main">
				<h2>Titel:</h2>
				<input name="" type="text"></p>
				<h2>Beschreibung:</h2>
				<textarea></textarea>
				<h2>Status:</h2>
				<select>
					<option>In Arbeit</option>
					<option>Fertig</option>
					<option>Unbearbeitet</option>
				</select>
				<input type="submit" value="Absenden">
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>