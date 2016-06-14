

<script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js" ></script >
  <script type = "text/javascript" >
        google . charts . load('current', {'packages':['gantt']});
    google . charts . setOnLoadCallback(drawChart);

    function drawChart()
    {

        var
        data = new google . visualization . DataTable();
        data . addColumn('string', 'Task ID');
        data . addColumn('string', 'Task Name');
        data . addColumn('date', 'Start Date');
        data . addColumn('date', 'End Date');
        data . addColumn('number', 'Duration');
        data . addColumn('number', 'Percent Complete');
        data . addColumn('string', 'Dependencies');

        data . addRows([
                <?php foreach($taskparent as $task): ?>


                ['<?php echo e($task->id); ?>', '<?php echo e($task->name); ?>',
                        new Date(<?php echo e($task->created_at->year); ?>,<?php echo e($task->created_at->month); ?>,<?php echo e($task->created_at->day); ?>,<?php echo e($task->created_at->hour); ?>,<?php echo e($task->created_at->minute); ?>), new Date(<?php echo e(date("Y",strtotime($task->date_jalon))); ?>, <?php echo e(date("m",strtotime($task->date_jalon))); ?>, <?php echo e(date("d",strtotime($task->date_jalon))); ?>,10), <?php echo e($task->duration/24); ?>, <?php echo e(round(($task->getElapsedDuration()*100/60/60)/$task->duration,1)); ?>, null],

                <?php endforeach; ?>
        ]);

        var
        options = {
        height:
        400,
        gantt: {
            trackHeight:
            30
        }
      };

      var chart = new google . visualization . Gantt(document . getElementById('chart_div'));

      chart . draw(data, options);
    }
  </script >

  <div id = "chart_div" ></div >