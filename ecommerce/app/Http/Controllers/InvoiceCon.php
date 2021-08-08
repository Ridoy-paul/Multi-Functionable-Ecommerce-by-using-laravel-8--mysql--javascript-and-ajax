<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;


class InvoiceCon extends Controller
{
    //Begin:: invoice Print in user
    public function FrontendInvoice($invID, $randID) {
        $ordersQ = DB::table('orders')
                    ->join('shipping_charges', 'orders.shippingID', 'shipping_charges.id')
                    ->select('orders.*', 'shipping_charges.name')
                    ->where('orders.invID', $invID)
                    ->first();
        
        //return view('mpdf.invoice', compact('ordersQ'));

        // $mpdf = new \Mpdf\Mpdf([
        //     'default_font_size'    => '12',
        //     'default_font'         => 'nikosh',
        // ]);

        // $mpdf = '<h1>Hello paul</h1>';
        // $mpdf->output();

        $data = [
			'foo' => 'hello 1',
            'bar' => 'hello 2'
		];
		$pdf = PDF::chunkLoadView('<html-separator/>', 'pdf.document', $data);
		return $pdf->stream('document.pdf');
    }
    //End:: invoice Print in user
}
