@php
$records = [60, 70, 80];
@endphp
@if (count($records) == 1)
    <div>I have one record! </div>
@elseif (count($records) > 1)
    <div>I have multiple records!</div>
@else
    <div>I don't have any records!</div>
@endif


<?php
$records = [60, 70, 80];
?>
<?php if (count($records) == 1) { ?>
    <div>I have one record! </div>
<?php }elseif (count($records) > 1) { ?>
    <div>I have multiple records!</div>
<?php }else{ ?>
    <div>I don't have any records!</div>
<?php } ?>

@php
$record1  = "niphon";
$record2  = "";
$record3  = null;
@endphp

@isset($record1)
   $record1 is defined and is not null... <br>
@endisset

@empty($record2)
   $record2 is "empty" with empty string <br>
@endempty

@empty($record3)
   $record3 is "empty" with null <br>
@endempty

@php
    $i = 5;
@endphp
@switch($i)
    @case(1)
        //do First case...
    @break

    @case(2)
        //do Second case...
    @break

    @case('helloworld')
        //do String case...
    @break

    @default
        //do Default case...
@endswitch
<?php for ($i = 0; $i < 10; $i++) { ?>
    The current value is <?php echo $i; ?>
<?php } ?>


