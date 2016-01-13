<div id="appointment-times">
    <?php foreach ($appointmentTimes as $appointmentTime => $valid): ?>
        <?php $class =  ($valid) ? 'can-appointment' : 'cant-appointment'; ?>
        <div class="appointment-time <?php echo $class; ?>" data-val="<?php echo $appointmentTime; ?>">
            <div class="appointment-info">
                <?php echo $appointmentTime; ?>
                <br>
                <?php echo ($valid) ? '可预约' : '已预约'; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>