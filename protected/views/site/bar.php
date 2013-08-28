
<?php 
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options'=>array(
   		'chart'=>array('type'=>$type),
   		
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
?>