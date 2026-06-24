<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class UpgradeController extends Controller
{
    public function __construct()
    {
        // Setup Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function umkm()
    {
        $user = Auth::user();
        
        if ($user->isUmkm()) {
            return redirect()->route('umkm.dashboard')
                             ->with('info', 'Anda sudah menjadi UMKM.');
        }

        return view('upgrade.umkm', compact('user'));
    }

    public function pembimbing()
    {
        $user = Auth::user();
        
        if ($user->isPembimbing()) {
            return redirect()->route('pembimbing.dashboard')
                             ->with('info', 'Anda sudah menjadi Pembimbing.');
        }

        return view('upgrade.pembimbing', compact('user'));
    }

    // ================== PEMBAYARAN UMKM ==================
    public function payUmkm(Request $request)
    {
        $user = Auth::user();
        $order_id = 'UMKM-' . time() . '-' . $user->id;

        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => 350000,           // Ubah sesuai harga UMKM kamu
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? '',
            ],
            'item_details' => [
                [
                    'id' => 'upgrade_umkm',
                    'price' => 350000,
                    'quantity' => 1,
                    'name' => 'Upgrade Menjadi UMKM (Include Pembimbing UMKM)'
                ]
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            // Simpan order_id sementara di session (untuk webhook nanti)
            session(['pending_order_id' => $order_id]);

            return view('upgrade.payment', compact('snapToken', 'order_id'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    // ================== PEMBAYARAN PEMBIMBING ==================
    public function payPembimbing(Request $request)
    {
        $user = Auth::user();
        $order_id = 'PEMB-' . time() . '-' . $user->id;

        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => 250000,           // Ubah sesuai harga Pembimbing kamu
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? '',
            ],
            'item_details' => [
                [
                    'id' => 'upgrade_pembimbing',
                    'price' => 250000,
                    'quantity' => 1,
                    'name' => 'Upgrade Menjadi Pembimbing Umum'
                ]
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            session(['pending_order_id' => $order_id]);

            return view('upgrade.payment', compact('snapToken', 'order_id'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }
}