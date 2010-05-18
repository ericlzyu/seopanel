<?php echo showSectionHead($sectionHead); ?>
<form id='search_form'>
<table width="48%" border="0" cellspacing="0" cellpadding="0" class="search">
	<tr>
		<th>Website: </th>
		<td>
			<?php echo $this->render('website/websiteselectbox', 'ajax'); ?>
		</td>
		<td colspan="2"><a href="javascript:void(0);" onclick="scriptDoLoadPost('directories.php', 'search_form', 'content', '&sec=skipped')"><img alt="" src="<?=SP_IMGPATH?>/show_records.gif"></a></td>
	</tr>
</table>
</form>

<?php
	if(empty($websiteId)){ showErrorMsg('No Websites Found!');} 
?>

<div id='subcontent'>
<?=$pagingDiv?>
<table width="100%" border="0" cellspacing="0" cellpadding="2px;" class="list" align='center'>
	<tr>
	<td width='33%'>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
	<tr class="listHead">
		<td class="left">Id</td>
		<td>Directory</td>
		<td class="right">Action</td>
	</tr>
	<?php
	$colCount = 3; 
	if(count($list) > 0){
		$catCount = count($list);
		$i = 0;
		foreach($list as $listInfo){
			
			$class = ($i % 2) ? "blue_row" : "white_row";
            if($catCount == ($i + 1)){
                $leftBotClass = "tab_left_bot";
                $rightBotClass = "tab_right_bot";
            }else{
                $leftBotClass = "td_left_border td_br_right";
                $rightBotClass = "td_br_right";
            }            
            $includeLink = "<a href='javascript:void(0);' onclick=\"scriptDoLoad('directories.php', 'content', 'sec=unskip&id={$listInfo['id']}&pageno=$pageNo&website_id=$websiteId')\">Undo</a>";
            
			?>
			<tr class="<?=$class?>">
				<td class="<?=$leftBotClass?>"><?=$listInfo['id']?></td>
				<td class='td_br_right'  style='text-align:left;padding-left:10px;'><?=$listInfo['domain']?></td>
				<td class="<?=$rightBotClass?>"><?=$includeLink?></td>
			</tr>
			<?php
			$i++;
		}
	}else{
		echo showNoRecordsList($colCount-2);		
	} 
	?>
	<tr class="listBot">
		<td class="left" colspan="<?=($colCount-1)?>"></td>
		<td class="right"></td>
	</tr>
	</table>
	</td>
	</tr>
</table>
</div>