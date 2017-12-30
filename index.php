<?php
$title = 'Finding Japanese Lyrics Now Has Been So Easy';
include 'core/header.php';
include 'admin/koneksi.php';

$query = $db->prepare ("SELECT * FROM posting, category WHERE posting.category = category.category ORDER BY date DESC LIMIT 2");
    $query->execute();
    $data = $query->fetchAll();

?>

<div class="maincontainer">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th style="width: 7%; text-align: center;">Category</th>
        <th style="width: 43%">File Name</th>
        <th style="width: 10%; text-align: center;">File Size</th>
        <th style="width: 16%; text-align: center;">Date</th>
        <th style="width: 8%; text-align: center;">GDrive</th>
        <th style="width: 8%; text-align: center;">Uptobox</th>
        <th style="width: 8%; text-align: center;">Mirror</th>
      </tr>
    </thead>

    <tbody class="tutorial_list"> 
    	<?php if($data > 0){ 
				foreach ($data as $value): 
				$tutorial_id = $value['idpost']; ?>
      <tr class="<?php echo $value['category'] ?>">

      	<td style="width: 7%; text-align: center;">
			<?php if ($value['category'] == "Dorama"){ ?>
			<img src="https://nyaa.si/static/img/icons/nyaa/4_4.png" alt="Dorama" title="Dorama">
			<?php } elseif ($value['category'] == "Animation"){ ?>
			<img src="https://nyaa.si/static/img/icons/nyaa/1_3.png" alt="Animation" title="Animation">
			<?php } else { ?>
			<img src="https://nyaa.si/static/img/icons/nyaa/5_2.png" alt="Other" title="Other">
			<?php } ?>
      	</td>

        <td style="width: 43%"><?php echo $value['file_name'] ?></td>
        <td style="width: 10%; text-align: center;"><?php echo $value['file_size'] ?></td>
        <td style="width: 16%; text-align: center;"><?php echo $value['date'] ?></td>
        <td style="width: 8%; text-align: center;"><a href ="<?php echo $value['google_drive'] ?>" target="_blank">Download</a></td>
        <td style="width: 8%; text-align: center;"><a href ="<?php echo $value['uptobox'] ?>" target="_blank">Download</a></td>
        <td style="width: 8%; text-align: center;"><a href ="<?php echo $value['mirror'] ?>" target="_blank">Download</a></td>
      </tr>
      	<?php endforeach; } ?>
    </tbody>
  </table>
<div class="show_more_main" id="show_more_main<?php echo $tutorial_id; ?>">
				<span id="<?php echo $tutorial_id; ?>" class="show_more" title="Load more posts">Show more</span>
				<span class="loding" style="display: none;"><span class="loding_txt"><i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="font-size:12px;"></i>Loading....</span></span>
				</div>

<div class="clearfix"></div>
</div>

<script>
$(document).ready(function(){
    $(document).on('click','.show_more',function(){
        var ID = $(this).attr('id');
        $('.show_more').hide();
        $('.loding').show();
        $.ajax({
            type:'POST',
            url:'getData.php',
            data:'idpost='+ID,
            success:function(html){
                $('#show_more_main'+ID).remove();
                $('.tutorial_list').append(html);
            }
        }); 
    });
});
</script>

<?php
include 'core/footer.php';
?>
