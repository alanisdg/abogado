<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Contract;
use App\Models\CreditorUpdate;
use App\Models\Update;

// Helpers
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use PDF;

class ActualizationController extends Controller
{
    protected $config = [
        "moduleName" => "Actualización",
        "moduleLabel" => "Actualización",
        "routeView" => "modules.actualize.",
        "routeLink" => "contracts",
        "add" => "Registrar Actualización",
        "typeRegister" => "contract"
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Change creditor
     */
    public function changeCreditor(Request $request)
    {
        // Register update
            $createUpdate = Update::create([
                'contract_id' => $request->input('contract_id'),
                'type' => 1,
                'current_creditor' => $request->input('current_creditor'),
                'new_creditor' => $request->input('new_creditor'),
                'observations' => $request->input('observations'),
            ]);

            if ($createUpdate) {
                Toastr::success("", "¡Actualización registrada!");
                return redirect('contract/actualize/'.$request->input('contract_id'));
            }
    }

    /**
     * Change strategy
     */
    public function changeStrategy(Request $request)
    {
        // Register update
            $createUpdate = Update::create([
                'contract_id' => $request->input('contract_id'),
                'type' => 2,
                'observations' => $request->input('observations'),
            ]);

            if ($createUpdate) {
                Toastr::success("", "¡Actualización registrada!");
                return redirect('contract/actualize/'.$request->input('contract_id'));
            }
    }

    /**
     * Account holder change
     */
    public function accountHolderChange(Request $request)
    {
        // Register update
            $createUpdate = Update::create([
                'contract_id' => $request->input('contract_id'),
                'type' => 4,
                'new_headline' => $request->input('new_account_holder'),
                'new_headline_rut' => $request->input('rut'),
                'observations' => $request->input('observations'),
            ]);

            if ($createUpdate) {
                Toastr::success("", "¡Actualización registrada!");
                return redirect('contract/actualize/'.$request->input('contract_id'));
            }
    }

    /**
     * Print document
     */
    public function printDocument($id, $type)
    {
        // Search data
            $data = Update::with(['contract', 'contract.collections'])->find($id);

        // Share data to view
            view()->share('data', $data);

        // Select type document
            if ($type == 1) { // Change creditor
                $pdf = PDF::loadView('modules.contracts.pdfs.change-creditor');
            }
            elseif ($type == 2) { // Change strategy
                $pdf = PDF::loadView('modules.contracts.pdfs.change-strategy');
            }
            elseif ($type == 4) { // Account holder change
                $pdf = PDF::loadView('modules.contracts.pdfs.account-holder-change');
            }

        // Download pdf
            return $pdf->download('Cambio_Acreedor.pdf');
    }
}
