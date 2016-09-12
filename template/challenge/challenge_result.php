<?php
if (!defined('IN_TEMPLATE')) {
    exit('Access denied');
}
$data = $tmpl['challenge_result_info'];
$result = json_decode($data['package'],true) ?? [];
//$result = $_E['template']['challenge_result_info']['result'];
?>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td>上傳編號</td>
						<td><?=$data['cid']?></td>
					</tr>
					<tr>
						<td>時間</td>
						<td><?=$data['timestamp']?></td>
					</tr>
					<tr>
						<td>題目</td>
						<td>
							<a href="<?=$SkyOJ->uri('problem','view',$data['pid'])?>">
								<?=\SKYOJ\Problem::get_title($data['pid'])?>
							</a>
						</td>
					</tr>
					<tr>
						<td>使用者</td>
						<?php
                        $nickname = \SKYOJ\nickname($data['uid']);
                        ?>
						<td><?=$nickname[$data['uid']]?></td>
					</tr>
					<tr>
						<td>總得分</td>
						<td><?=\SKYOJ\getresulttexthtml($data['result'])?>, <?=$data['score']?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-8">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>State</th>
						<th>Runtime</th>
                        <th>Memory</th>
					</tr>
				</thead>
				<tbody>
                <?php $t = '' ; foreach ($result as $i): $t = $i['msg']??''?>
					<tr>
                        <td><?=$i['taskid']?></td>
						<td><?=\SKYOJ\getresulttexthtml($i['state'])?></td>
						<td><?=$i['runtime']?></td>
                        <td><?=$i['mem']?></td>
					</tr>
                <?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php if( $data['uid']==$_G['uid'] || \userControl::isAdmin($_G['uid']) ):?>
		<?php if($data['result']==0):?>
		<div class="row">
			<a href="<?=$SkyOJ->uri('problem','api','judge')?>?cid=<?=$data['cid']?>">Judge Me</a>
		</div>
		<?php endif;?>
		<?php if( !empty($t) ):?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Judge Information</div>
					<div class="panel-body">
						<div class="container-fluid">
							<?= htmlentities($t) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endif;?>
		<div class="row">
			<div class="col-md-12">
				<?php 
					$tmpl['defaultcode'] = $data['code'];
					Render::renderSingleTemplate('common_codepanel'); 
				?>
			</div>
		</div>
	<?php endif;?>
</div>