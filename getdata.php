<?php
include 'admin/koneksi.php';
if(isset($_POST["idpost"]) && !empty($_POST["idpost"])){

//include database configuration file

//count all rows except already displayed
$query = $db->prepare ("SELECT COUNT(*) FROM posting WHERE idpost < ".$_POST['idpost']." ORDER BY date DESC");
$query->execute();
$data = $query->fetchAll();
$showLimit = 1;

//get rows query
$query = $db->prepare ("SELECT * FROM posting, category WHERE posting.category = category.category AND idpost  < ".$_POST['idpost']." ORDER BY date DESC LIMIT ".$showLimit);
$query->execute();
$data = $query->fetchAll();
?>



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
      	<?php endforeach;
				if($data > $showLimit){ ?>

				<div class="show_more_main" id="show_more_main<?php echo $tutorial_id; ?>">
				<span id="<?php echo $tutorial_id; ?>" class="show_more" title="Load more posts" href="#" style="text-decoration: none;">Show more</span>
				<span class="loding" style="display: none;"><span class="loding_txt"><i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="font-size:12px;"></i>Loading....</span></span>
				</div>
				<div class="clearfix"></div>
				<?php }   
				} 
				}
				
?>
