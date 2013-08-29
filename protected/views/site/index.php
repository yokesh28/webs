 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
 <form>

<?php echo CHtml::dropDownList('barTyp','',CHtml::listData(Type::model()->findAll(),'type','type'),array('onChange'=>'js:changeValue();'))?>
<?php echo CHtml::dropDownList('month','', CHtml::listData(Month::model()->findAll(),'id','month'),array('onChange'=>'js:changeValue();'))?>
</form>
<img src="images/loader.gif" style="width: 40px;margin: 120px 430px;display:none" id="preloader" >
<script>
function changeValue()
{
	$('#preloader').show();
	
$.ajax({
	  url: "<?php echo Yii::app()->createAbsoluteUrl('/site/bar')?>",
	  data:$("form").serialize(),
	}).done(function(html) {
	  $('#dataLoadbar').html(html);
	  $('#preloader').hide();
	});
	
}
</script>



<div id='dataLoadbar'>

<?php 
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
   		'chart'=>array('type'=>'bar'),
   		
      'title' => array('text' => 'Consumption'),
      'xAxis' => array(
         'categories' => array('A', 'B','C')
      ),
      'yAxis' => array(
         'title' => array('text' => 'Fruit eaten')
      ),
      'series' =>$value,
   )
));
?></div>