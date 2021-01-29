<?php declare(strict_types=1);

class View {
	public function __construct($PDOStatementObject){	
		echo("<table border=\"3\"><thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th></tr></thead><tbody>");
		while($row=$PDOStatementObject->fetch()){
			echo '<tr><th>'.$row['id'].'</th><th>'.$row['users_firstname'].'</th><th>'.$row['users_lastname'].'</th><th>'.$row['users_dateofbirth'].'</th></tr>';
		}
		echo("</tbody></table><br><br>");
		echo("<form action=\"".get_permalink()."\" method=\"post\">
			<input name=\"input\" type=\"text\" size=\"40\" value=\"\" />
			<input type=\"submit\" value=\"EXECUTE  (to execute the code in the previous input box)\" />
			</form>
		");
	}
}