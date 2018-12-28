<br><br>
<div class="container">
	<section class="py-5" style="min-height:330px;">    	    
		<h1>Your Watch List</h1> 
		<br>		
		<table id="watchList" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Title</th>
						<th>Overview</th>									
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php											
					foreach($watchlist as $watch){
						echo "<tr>";								
						echo "<td>".$watch['movie_title']."</td>";
						echo "<td>".$watch['movie_overview']."</td>";
						echo "<td><input type='Submit' class='btn btn-danger' value='Remove' id='remove_from_watchlist' movieid='".$watch['movie_id']."'></td>";
						echo "</tr>";
					}
				?>
				</tbody>
				<tfoot>
					<tr>
						<th>Title</th>
						<th>Overview</th>									
						<th>Actions</th>
					</tr>
				</tfoot>
			</table>	
		
	</section>
</div>