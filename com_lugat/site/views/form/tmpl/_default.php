<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
require_once(JPATH_COMPONENT.DS.'lib/cloud.php');
$document    = & JFactory::getDocument();
$document->addStyleSheet($this->baseurl.'/components/com_lugat/css/jquery.autocomplete.css');
$document->addStyleSheet($this->baseurl.'/components/com_lugat/css/style.css');
$document->addScript($this->baseurl.'/components/com_lugat/js/scripts.js');
$document->addScript($this->baseurl.'/components/com_lugat/js/jquery.js');
$document->addScript($this->baseurl.'/components/com_lugat/js/jquery.autocomplete.js');
$document->addScriptDeclaration("

function find_term(s_term) {
	$('#results').html('<img src=\'".$this->baseurl."/images/indicator.gif\'>');
	$.get('".$this->baseurl."/components/com_lugat/lib/translate_".$this->dic.".php', { SearchWord: s_term },
	function(data) {
		$('#results').html(data);
		s_term_append = '<a href=\"#\" onclick=\'user_term(\"'+s_term+'\")\'>'+s_term+'</a> ';
		var idx = window.arr_user_terms.indexOf(s_term);
		if (idx == -1) {
			window.arr_user_terms.push(s_term);
			$('#your_terms').append(s_term_append);
		}
		$('#box_your_search').css('display','block');
	});	
}

function user_term(s_term) {
	find_term(s_term);
	$('#SearchWord').val(s_term);
}

$().ready(function() {

	window.arr_user_terms = new Array();
	
	$('.l_word').click(function() {
		s_term = $(this).html();
		find_term(s_term);
		$('#SearchWord').val(s_term);
	});

	$('#searchbtn').click(function() {
		s_term = $('#SearchWord').val();
		find_term(s_term);
	});

	$('#SearchWord').autocomplete('".
	$this->baseurl.'/components/com_lugat/lib/search_'.$this->dic.'.php'
	."', {
		width: 235,
		selectFirst: false
	});
	$('#SearchWord').result(function(event, data, formatted) {
		if (data)
			$(this).parent().next().find('input').val(data[0]);
	});
});");
?>
<h3><?php echo $this->title['enter']; ?>:</h3>
<?php if($this->tj_btn): ?>
	<p>
	<input type='button' value='&#1171;' onclick='CharsTJ("ғ")'>
	<input type='button' value='&#1251;' onclick='CharsTJ("ӣ")'>
	<input type='button' value='&#1179;' onclick='CharsTJ("қ")'>
	<input type='button' value='&#1263;' onclick='CharsTJ("ӯ")'>
	<input type='button' value='&#1203;' onclick='CharsTJ("ҳ")'>
	<input type='button' value='&#1207;' onclick='CharsTJ("ҷ")'>
	</p>
<?php endif; ?>
<p><input type="text" name="SearchWord" id="SearchWord" maxlength='70' size='35' value="<?php if(isset($t)) echo $t; ?>"/>
<input type="button" value="<?php echo $this->title['button']; ?>" class=".btn" name="searchbtn" id="searchbtn">
<p id='results' name='results'></p>
<h3><?php echo $this->title['total_amount']; ?></h3>
<div class='tagcloud' style="display: none;" id='box_your_search'>
<span class="tagcloud_head"><?php echo $this->title['your_search']; ?>:</span>
<br/>
<span id='your_terms'>
</span>
</div>
<div class='tagcloud'>
<span class="tagcloud_head"><?php echo $this->title['latest_words']; ?>:</span>
<br/>
<?php echo $this->latest_words; ?>
</div>
<div class='tagcloud'>
<span class="tagcloud_head"><?php echo $this->title['top_words']; ?>:</span>
<br/>
<?php echo $this->top_words; ?>
</div>
<div style="margin-top: 5px">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5942772454375947";
/* Oftob.com Middle 728x90 */
google_ad_slot = "1331770315";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>

<p>
<?php 
  $comments = JPATH_SITE . DS .'components' . DS . 'com_jcomments' . DS . 'jcomments.php';
  if (file_exists($comments)) {
    require_once($comments);
    echo JComments::showComments($this->id, 'com_lugat', $this->dic);
  }
?>
