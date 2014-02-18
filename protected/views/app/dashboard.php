<div class="row-fluid">
  <div class="span12">
    <?php if($pc):?>
    <div class="row-fluid">
    <?php $box = $this->beginWidget(
      'bootstrap.widgets.TbBox',
      array(
        'title' => 'Sales By Category',
        'headerIcon' => 'icon-th-list',
        'htmlOptions' => array('class' => 'bootstrap-widget-table')
      )
    );?>
      <div class="span4 well">
        <table class='table table-order'>
          <thead>
            <tr>
              <th>Category</th>
              <th>Qty</th>
              <th>Amount</th>
            </tr>
          </thead>
        <?php $pcdata=array();?>
        <?php foreach($pc as $c):?>
          <?php array_push($pcdata,array($c['name'],(int) $c['amt']))?>
          <tbody>
           <tr>
              <td><?=$c['name']?></td>
              <td><?=$c['cnt']?></td>
              <td><?=$c['amt']?></td>
           </tr>
          </tbody>
        <?php endforeach;?>
        </table>
      </div>
      <div class="span4">
        <?php
        $this->widget(
          'bootstrap.widgets.TbHighCharts',                                         
          array(
            'options' => array(
              'credits'=>false,
              'title'=>array('text'=>''),                       
              'plotOptions'=>array(                                                 
                'pie'=>array(
                  'allowPointSelect'=>true,                                          
                  'cursor'=>'pointer',
                  'dataLabels'=>array(
                    'enabled'=>true,
                    'format'=>'</b>{point.name}</b>:{point.percentage:.1f}'
                  ),
                  'showInLegend'=>true,
                )                                          
              ),
              'series' => array(
               array('name' => 'amount',
                 'type'=>'pie','data' => $pcdata
               ),
              ),                                                                    
            )                                                                       
          )                                                                         
        );                                                                          
      ?>
     <?php $this->endWidget()?>
      </div>
    </div>
    <?php endif;?>

    <?php if($avgphr):?>
<?php
  $hours=array();
  foreach(range(0,23) as $v){                                                       
    $hours[$v]=date('g:iA',strtotime($v.':00'));
  }
  $odr_per_hour=array();
  $series =array();                                                                 
  foreach($avgphr as $r){
    $odr_per_hour[$r['hr']]=(int) $r['avg_cnt'];                       
  }
    $tmp=array();
    foreach($hours as $i=>$hr){             
      $tmp['name']=' Average No. of Orders ';
      if(array_key_exists($i,$odr_per_hour))
        $tmp['data'][]=$odr_per_hour[$i];                                                      
      else
        $tmp['data'][]=0;
    }
    $series[]=$tmp;
?>


    <div class="row-fluid">
      <div class="span12">
      <?php
        $this->widget(
          'bootstrap.widgets.TbHighCharts',
          array(
            'options' => array(
              'chart'=>array('type'=>'bar','height'=>1000),
              'credits'=>false,
              'title'=>array('text'=>'Average Number of Orders Per Hour'),
              'plotOptions'=>array(
                'bar'=>array(
                    'dataLabels'=>array(
                        'enabled'=> true
                   )
                )
              ),
              'legend'=>array(
                'layout'=> 'vertical',
                'align'=> 'right',
                'verticalAlign'=> 'top',
                'x'=> -200,
                'y'=> 300,
                'floating'=> true,
                'borderWidth'=> 1,
                'backgroundColor'=> '#FFFFFF',
                'shadow'=> true
              ),
              'yAxis'=> array(
                'min' =>0,
                'title'=>array(
                  'text'=>'Year 2013'
                ),
                'labels'=>array('overflow'=>'justify    '),
              ),
              'xAxis'=>array(
               'categories'=>$hours
              ),
              'series' => $series
            )
           )
        );
      ?>
      </div>
    </div>
    <?php endif;?>


    <?php if($ds):?>
    <div class="row-fluid">
    <?php $box = $this->beginWidget(
      'bootstrap.widgets.TbBox',
      array(
        'title' => 'Daily Sales',
        'headerIcon' => 'icon-th-list',
        'htmlOptions' => array('class' => 'bootstrap-widget-table')
      )
    );?>
      <div class="span12">
        <?php foreach($ds as $d):?>
          <?php 
           $dscat[]=$d['dy'];
           $dsdata[]=(int) $d['amt'];
          ?>
        <?php endforeach;?>
        <?php
        $this->widget(
          'bootstrap.widgets.TbHighCharts',                                         
          array(
            'options' => array(
              'chart'=>array(
                'type'=>'column',
              ),
              'credits'=>false,
              'title'=>array('text'=>''),                       
              'plotOptions'=>array(                                                 
                'pie'=>array(
                  'pointPadding'=>0.2,
                  'borderWidth'=>0
                )                                          
              ),
              'xAxis'=>array(
                'categories'=>$dscat,
              ),
              'series' => array(array('name'=>'Amount','data'=>$dsdata))
            )                                                                       
          )                                                                         
        );                                                                          
      ?>
      </div>
     <?php $this->endWidget()?>
    </div>

    <?php endif;?>
    <?php if($ms):?>

    <div class="row-fluid">
    <?php $box = $this->beginWidget(
      'bootstrap.widgets.TbBox',
      array(
        'title' => 'Monthly Sales',
        'headerIcon' => 'icon-th-list',
        'htmlOptions' => array('class' => 'bootstrap-widget-table')
      )
    );?>
      <div class="span12">
        <?php $msdata=array();?>
        <?php foreach($ms as $m):?>
          <?php 
           $mscat[]=$m['mnth'];
           $msdata[]=(int) $m['amt'];
          ?>
        <?php endforeach;?>
        <?php
        $this->widget(
          'bootstrap.widgets.TbHighCharts',                                         
          array(
            'options' => array(
              'chart'=>array(
                'type'=>'column',
              ),
              'credits'=>false,
              'title'=>array('text'=>''),                       
              'plotOptions'=>array(                                                 
                'pie'=>array(
                  'pointPadding'=>0.2,
                  'borderWidth'=>0
                )                                          
              ),
              'xAxis'=>array(
                'categories'=>$mscat,
              ),
              'series' => array(array('name'=>'Amount','data'=>$msdata))
            )                                                                       
          )                                                                         
        );                                                                          
      ?>
      </div>
     <?php $this->endWidget()?>
    </div>

    <?php endif;?>


  </div>
</div>
