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
        $body = ($data->status_pengajuan == 'Rejected')
        ? 'Mohon maaf, pengajuan Anda ditolak oleh OPD untuk project ini. Anda dapat mengajukan ulang dengan memperbaiki data yang diperlukan.'
        : 'Pengajuan Anda telah berhasil diverifikasi oleh OPD. Project dapat segera dijalankan.';

        $user = User::where('name',$data->name)->first();
        $this->crud->create([
            'user_id' => $user->id,
            'jenis' => $data->jenis_magang,
            'status' => $data->status_pengajuan,
            'title' => 'Status project '.$data->jenis_magang,
            'body' => $body
        ]);

    }
}
