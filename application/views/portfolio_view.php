<h1>Портфолио</h1>
<p>
	<table>
		Все проекты являються вымышлеными, поэтому даже не питайтесь перейти по приведенным ссылкам.
		<tr>
			<td>Год</td>
			<td>Проект</td>
			<td>Описание</td>
		</tr>
		<?php
			foreach ($data as $row) 
			{
				echo '<tr><td>' . $row['Year'] . '</td><td>' . $row['Site'] . '</td><td>' . $row['Description'] . '</td></tr>';
			}
		?>
	</table>
	<p> &copy; Stanisap - Don't copyrite this text! </p>
</p>