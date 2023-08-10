<?php
    use App\Models\Notifications;
?>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-regular fa-bell"></i> 

        <?php if ($this->amountNotifications() > 0) : ?>
            
            <p class="amount-notify"><?=$this->amountNotifications();?></p>
        
        <?php endif; ?>
    </a>
    <ul class="dropdown-menu">
        <?php $notifications = Notifications::showUserNotifications(); ?>


        <?php if (!$notifications->isEmpty()) : ?>
            <?php foreach($notifications as $notification) :  $notification->refresh(); ?>
                <li class="notify-<?=$notification->id;?>" wire:click="deleteAndRedirect('{{$notification->link}}', {{$notification->id}})">
                    <a class="dropdown-item"><?=$notification->content;?></a>
                </li>
                <li><hr class="dropdown-divider"></li>
            <?php endforeach; ?>
        <?php else : ?>
            No new notifications.
        <?php endif; ?>
    </ul>
</li>
