<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\User;
use App\Notifications\SendNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\OrangeSmsService;

class DashAppointmentController extends Controller
{
    // protected $orangeSmsService;

    // public function __construct(OrangeSmsService $orangeSmsService)
    // {
    //     $this->orangeSmsService = $orangeSmsService;
    // }

    public function index(Request $request){
        $query = Appointments::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $appointments = $query
            ->orderByRaw("FIELD(status, 'confirmed', 'pending', 'completed', 'cancelled', 'rejected')")
            ->orderByDesc('date')
            ->orderBy('time', 'asc')
            ->paginate(15);

        return view('admin.appointment.index', compact('appointments'));
    }
    public function show($id)
    {
        $appointment = Appointments::findOrFail($id);
        return view("admin.appointment.show", compact("appointment"));
    }
    public function accept($id)
    {
        $appointment = Appointments::findOrFail($id);
        $appointment->status = 'confirmed';
        $appointment->save();
        $user = User::find($appointment->user_id);


        // // send sms
        // $recipientPhoneNumber = '+237658822337';
        // $message = 'Votre Rendez-vous chez Glow & Chic Eden Garden a vien detre confirme. A bientot';
        // $useAlphanumeric = false;
        // $smsResult = $this->orangeSmsService->sendSms($recipientPhoneNumber, $message, $useAlphanumeric);
        // if ($smsResult['success']) {
        //     Log::info('Order confirmation SMS sent successfully.', ['recipient' => $recipientPhoneNumber, 'api_response' => $smsResult['data']]);
        //     return response()->json([
        //         'message' => 'Order confirmed and SMS sent successfully!',
        //         'sms_status' => $smsResult['data']
        //     ]);
        // } else {
        //     Log::error('Failed to send order confirmation SMS.', ['recipient' => $recipientPhoneNumber, 'error' => $smsResult['message']]);
        //     return response()->json([
        //         'message' => 'Order confirmed, but failed to send SMS.',
        //         'sms_error' => $smsResult['message'],
        //         // 'api_errors' => $smsResult['response']
        //     ], 500);
        // }



        // notify 
         if ($user->fcm_token) {    
            $user->notify(new SendNotification(
                name: $user->name,
                title: 'Rendez-vous confirmer!',
                body: ' Votre rendez-vous du ' . $appointment->date . ' à ' . $appointment->time . ' a ete confirmer!',
                url: '/appointment' // optional click action
            ));
         }

        return redirect()->route('DashAppointment.index')->with('success', 'Appointment accepted successfully.');
    }

    public function reject($id)
    {
        $appointment = Appointments::findOrFail($id);
        $appointment->status = 'rejected';
        $appointment->save();

        // notify 
        $user = User::find($appointment->user_id);
         if ($user->fcm_token) {    
            $user->notify(new SendNotification(
                name: $user->name,
                title: 'Rendez-vous rejeter!',
                body: ' Votre rendez-vous du ' . $appointment->date . ' à ' . $appointment->time . ' a ete rejeter!',
                url: '/appointment' // optional click action
            ));
         }

        return redirect()->route('DashAppointment.index')->with('success', 'Appointment rejected successfully.');
    }public function complete($id)
    {
        $appointment = Appointments::findOrFail($id);
        $appointment->status = 'completed';
        $appointment->save();

        // notify 
        $user = User::find($appointment->user_id);
         if ($user->fcm_token) {    
            $user->notify(new SendNotification(
                name: $user->name,
                title: 'Rendez-vous terminer!',
                body: ' Votre rendez-vous du ' . $appointment->date . ' à ' . $appointment->time . ' a ete terminer!',
                url: '/appointment' // optional click action
            ));
         }
        return redirect()->route('DashAppointment.index')->with('success', 'Appointment completed successfully.');
    }
}
