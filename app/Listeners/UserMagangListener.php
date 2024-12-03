<?php

namespace App\Listeners;

use App\Events\UserMagangEvent;
use App\Models\Magang;
use App\Models\Notification;
use App\Models\User;
use App\Repository\Interface\CrudInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserMagangListener
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
    public function handle(UserMagangEvent $event): void
    {
        $user_magang = $event->getUserMagang();
        $data = Magang::find($user_magang->magang_id);

        $body = ($user_magang->status == 'Rejected')
        ? 'Terima kasih atas minat Anda untuk '.$data->jenis_magang.', namun dengan berat hati kami belum dapat menerima Anda kali ini. Kami berharap Anda sukses dalam kesempatan lainnya.'
        : 'Selamat, Anda diterima sebagai peserta '.$data->jenis_magang.'. Kami berharap Anda dapat memberikan kontribusi positif dan mendapatkan pengalaman berharga selama program ini.';

        $user = User::where('id',$user_magang->user_id)->first();
        $this->crud->create([
            'user_id' => $user->id,
            'jenis' => $data->jenis_magang,
            'status' => $user_magang->status,
            'title' => 'Status project '.$data->jenis_magang,
            'body' => $body
        ]);
    }
}
