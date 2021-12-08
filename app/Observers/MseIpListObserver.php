<?php

namespace App\Observers;

use App\Models\MseIpList;
use Illuminate\Support\Facades\Cache;

class MseIpListObserver
{
    /**
     * Handle the MseIpList "created" event.
     *
     * @param  \App\Models\MseIpList  $mseIpList
     * @return void
     */
    public function created(MseIpList $mseIpList)
    {
        Cache::forget('mse_ip_list');
    }

    /**
     * Handle the MseIpList "updated" event.
     *
     * @param  \App\Models\MseIpList  $mseIpList
     * @return void
     */
    public function updated(MseIpList $mseIpList)
    {
        //
    }

    /**
     * Handle the MseIpList "deleted" event.
     *
     * @param  \App\Models\MseIpList  $mseIpList
     * @return void
     */
    public function deleted(MseIpList $mseIpList)
    {
        //
    }

    /**
     * Handle the MseIpList "restored" event.
     *
     * @param  \App\Models\MseIpList  $mseIpList
     * @return void
     */
    public function restored(MseIpList $mseIpList)
    {
        //
    }

    /**
     * Handle the MseIpList "force deleted" event.
     *
     * @param  \App\Models\MseIpList  $mseIpList
     * @return void
     */
    public function forceDeleted(MseIpList $mseIpList)
    {
        //
    }
}
