<?php

namespace App\Listeners;

use App\Events\MagangEvent;
use App\Models\Notification;
use App\Repository\Interface\CrudInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;

class NotificationListener
{
    protected $crud;
    /**
     * Create the event listener.
     */
    public function __construct(CrudInterface $crudInterface)
    {
        $this->crud = $crudInterface;
        $this->crud->setModel(Notification::class);
    }

    /**
     * Handle the event.
     */
    public function handle(MagangEvent $event): void
    {
        $data = $event->getMagang();
        $this->crud->create([
            'user_id' => $data->user_id,
            'status' => 'Approved',
            'jenis' => $data->jenis_magang,
            'title' => 'project '.$data->title,
            'body' => 'Program magang baru dengan judul '.$data->title.' berhasil ditambahkan ke daftar program'
        ]);

    }
}
