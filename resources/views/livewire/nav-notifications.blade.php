<?php
    use App\Models\Notifications;
?>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-regular fa-bell"></i> 

        <?php if ($this->amountNotifications() > 0) : ?>
            
            <p class="notification__amount"><?=$this->amountNotifications();?></p>
        
        <?php endif; ?>
    </a>
    <ul class="dropdown-menu notification__menu">
        <?php $notifications = Notifications::showUserNotifications(); ?>


        <?php if ($notifications->isNotEmpty()) : ?>
            <?php $x = 0; ?>
            <?php foreach($notifications as $notification) :  $notification->refresh(); ?>
                <?php if ($x < 11) : ?>
                    <li class="notify-<?=$notification->id;?>"
                    wire:click="deleteAndRedirect('{{$notification->link}}', {{$notification->id}})">
                        <a class="dropdown-item"><?=$notification->content;?></a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <?php $x++; ?>
                    <?php if ($x === 11) : ?>
                        <a href="/" class="dropdown-item"><u>See all notifications</u></a>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>

        <?php else : ?>
            No new notifications.
        <?php endif; ?>
    </ul>
</li>
