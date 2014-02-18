<?php
    function numberGenerator($type,$digits=6){
      $no = Counter::model()->findByPk($type);
      $no->saveCounters(array('value'=>1));
      $no->save();
      return $no->code.str_pad($no->value,$digits,0,STR_PAD_LEFT);
    }
?>
